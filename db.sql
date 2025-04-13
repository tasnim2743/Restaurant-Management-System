-- ====================================
-- 0. Drop Existing Database and Create New One
-- ====================================

-- Drop the database if it already exists
DROP DATABASE IF EXISTS restaurant_management_system;

-- Create a new database
CREATE DATABASE restaurant_management_system;

-- Select the newly created database for use
USE restaurant_management_system;

-- ====================================
-- 1. Roles Table
-- ====================================
CREATE TABLE Roles (
    RoleID INT AUTO_INCREMENT PRIMARY KEY,
    RoleName VARCHAR(50) NOT NULL UNIQUE
);

-- Insert default roles
INSERT INTO Roles (RoleName) VALUES ('Admin'), ('Staff'), ('Customer');

-- ====================================
-- 2. Users Table
-- ====================================
CREATE TABLE Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL UNIQUE,
    PasswordHash VARCHAR(255) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    FullName VARCHAR(100),
    RoleID INT NOT NULL,
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (RoleID) REFERENCES Roles(RoleID)
);

-- ====================================
-- 3. Categories Table
-- ====================================
CREATE TABLE Categories (
    CategoryID INT AUTO_INCREMENT PRIMARY KEY,
    CategoryName VARCHAR(100) NOT NULL UNIQUE,
    Description TEXT
);

-- ====================================
-- 4. MenuItems Table
-- ====================================
CREATE TABLE MenuItems (
    MenuItemID INT AUTO_INCREMENT PRIMARY KEY,
    CategoryID INT NOT NULL,
    Name VARCHAR(100) NOT NULL,
    Description TEXT,
    Price DECIMAL(10,2) NOT NULL,
    IsAvailable BOOLEAN DEFAULT TRUE,
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UpdatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID),
    CONSTRAINT chk_menuitem_price_nonnegative CHECK (Price >= 0)
);

-- ====================================
-- 5. Tables Table
-- ====================================
CREATE TABLE Tables (
    TableID INT AUTO_INCREMENT PRIMARY KEY,
    TableNumber INT NOT NULL UNIQUE,
    Capacity INT NOT NULL CHECK (Capacity > 0),
    IsAvailable BOOLEAN DEFAULT TRUE
);

-- ====================================
-- 6. Reservations Table
-- ====================================
CREATE TABLE Reservations (
    ReservationID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT NOT NULL,
    TableID INT NOT NULL,
    ReservationTime DATETIME NOT NULL,
    NumberOfGuests INT NOT NULL CHECK (NumberOfGuests > 0),
    Status ENUM('Pending', 'Confirmed', 'Cancelled') DEFAULT 'Pending',
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (TableID) REFERENCES Tables(TableID)
);

-- ====================================
-- 7. Orders Table
-- ====================================
CREATE TABLE Orders (
    OrderID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT NOT NULL,
    TableID INT,
    OrderTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Status ENUM('Pending', 'In Progress', 'Completed', 'Cancelled') DEFAULT 'Pending',
    TotalAmount DECIMAL(10,2) DEFAULT 0.00,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (TableID) REFERENCES Tables(TableID),
    CONSTRAINT chk_orders_total_nonnegative CHECK (TotalAmount >= 0)
);

-- ====================================
-- 8. OrderItems Table
-- ====================================
CREATE TABLE OrderItems (
    OrderItemID INT AUTO_INCREMENT PRIMARY KEY,
    OrderID INT NOT NULL,
    MenuItemID INT NOT NULL,
    Quantity INT NOT NULL DEFAULT 1 CHECK (Quantity > 0),
    Price DECIMAL(10,2) NOT NULL CHECK (Price >= 0),
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID) ON DELETE CASCADE,
    FOREIGN KEY (MenuItemID) REFERENCES MenuItems(MenuItemID)
);

-- ====================================
-- 9. Payments Table
-- ====================================
CREATE TABLE Payments (
    PaymentID INT AUTO_INCREMENT PRIMARY KEY,
    OrderID INT NOT NULL,
    PaymentMethod ENUM('Credit Card', 'Debit Card', 'PayPal', 'Cash') NOT NULL,
    PaymentStatus ENUM('Pending', 'Completed', 'Failed') DEFAULT 'Pending',
    Amount DECIMAL(10,2) NOT NULL CHECK (Amount >= 0),
    PaymentTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    TransactionID VARCHAR(100),
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID)
);

-- ====================================
-- 10. EmployeeSchedules Table
-- ====================================
CREATE TABLE EmployeeSchedules (
    ScheduleID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT NOT NULL,
    ShiftDate DATE NOT NULL,
    ShiftStart TIME NOT NULL,
    ShiftEnd TIME NOT NULL,
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

-- ====================================
-- 11. Inventory Table
-- ====================================
CREATE TABLE Inventory (
    InventoryID INT AUTO_INCREMENT PRIMARY KEY,
    ItemName VARCHAR(100) NOT NULL UNIQUE,
    Quantity INT NOT NULL DEFAULT 0,
    Unit VARCHAR(50),
    ReorderLevel INT NOT NULL DEFAULT 10,
    LastUpdated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT chk_inventory_quantity_nonnegative CHECK (Quantity >= 0)
);

-- ====================================
-- 12. Feedback Table
-- ====================================
CREATE TABLE Feedback (
    FeedbackID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    OrderID INT,
    Rating INT CHECK (Rating >= 1 AND Rating <= 5),
    Comments TEXT,
    FeedbackTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID)
);

-- ====================================
-- Indexes for Performance Optimization
-- ====================================
CREATE INDEX idx_users_role ON Users(RoleID);
CREATE INDEX idx_menuitems_category ON MenuItems(CategoryID);
CREATE INDEX idx_reservations_user ON Reservations(UserID);
CREATE INDEX idx_reservations_table ON Reservations(TableID);
CREATE INDEX idx_orders_user ON Orders(UserID);
CREATE INDEX idx_orders_table ON Orders(TableID);
CREATE INDEX idx_orderitems_order ON OrderItems(OrderID);
CREATE INDEX idx_orderitems_menuitem ON OrderItems(MenuItemID);
CREATE INDEX idx_payments_order ON Payments(OrderID);
CREATE INDEX idx_employeeschedule_user ON EmployeeSchedules(UserID);
CREATE INDEX idx_feedback_user ON Feedback(UserID);
CREATE INDEX idx_feedback_order ON Feedback(OrderID);

-- ====================================
-- Triggers to Handle Edge Cases
-- ====================================

-- 1. Prevent Overlapping Reservations
DELIMITER //

CREATE TRIGGER trg_prevent_overlapping_reservations
BEFORE INSERT ON Reservations
FOR EACH ROW
BEGIN
    DECLARE overlapping_count INT;

    SELECT COUNT(*) INTO overlapping_count
    FROM Reservations
    WHERE TableID = NEW.TableID
      AND Status IN ('Pending', 'Confirmed')
      AND (
          (NEW.ReservationTime BETWEEN ReservationTime AND DATE_ADD(ReservationTime, INTERVAL 2 HOUR))
          OR
          (DATE_ADD(NEW.ReservationTime, INTERVAL 2 HOUR) BETWEEN ReservationTime AND DATE_ADD(ReservationTime, INTERVAL 2 HOUR))
      );

    IF overlapping_count > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Table is already reserved for the selected time.';
    END IF;
END;//

-- 2. Check Number of Guests Against Table Capacity
CREATE TRIGGER trg_check_guest_capacity
BEFORE INSERT ON Reservations
FOR EACH ROW
BEGIN
    DECLARE table_capacity INT;

    SELECT Capacity INTO table_capacity
    FROM Tables
    WHERE TableID = NEW.TableID;

    IF NEW.NumberOfGuests > table_capacity THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Number of guests exceeds table capacity.';
    END IF;
END;//

-- 3. Update Orders.TotalAmount After Inserting OrderItems
CREATE TRIGGER trg_update_order_total_insert
AFTER INSERT ON OrderItems
FOR EACH ROW
BEGIN
    UPDATE Orders
    SET TotalAmount = TotalAmount + (NEW.Price * NEW.Quantity)
    WHERE OrderID = NEW.OrderID;
END;//

-- 4. Update Orders.TotalAmount After Updating OrderItems
CREATE TRIGGER trg_update_order_total_update
AFTER UPDATE ON OrderItems
FOR EACH ROW
BEGIN
    UPDATE Orders
    SET TotalAmount = TotalAmount + ((NEW.Price * NEW.Quantity) - (OLD.Price * OLD.Quantity))
    WHERE OrderID = NEW.OrderID;
END;//

-- 5. Update Orders.TotalAmount After Deleting OrderItems
CREATE TRIGGER trg_update_order_total_delete
AFTER DELETE ON OrderItems
FOR EACH ROW
BEGIN
    UPDATE Orders
    SET TotalAmount = TotalAmount - (OLD.Price * OLD.Quantity)
    WHERE OrderID = OLD.OrderID;
END;//

-- 6. Ensure Payments.Amount Equals Orders.TotalAmount
CREATE TRIGGER trg_check_payment_amount
BEFORE INSERT ON Payments
FOR EACH ROW
BEGIN
    DECLARE order_total DECIMAL(10,2);

    SELECT TotalAmount INTO order_total
    FROM Orders
    WHERE OrderID = NEW.OrderID;

    IF NEW.Amount != order_total THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Payment amount does not match order total.';
    END IF;
END;//

-- 7. Prevent Negative Inventory Quantities
CREATE TRIGGER trg_prevent_negative_inventory
BEFORE UPDATE ON Inventory
FOR EACH ROW
BEGIN
    IF NEW.Quantity < 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Inventory quantity cannot be negative.';
    END IF;
END;//

DELIMITER ;

-- ====================================
-- Sample Data Insertion (Extended)
-- ====================================

-- 1. Insert sample users
INSERT INTO Users (Username, PasswordHash, Email, FullName, RoleID) VALUES
('admin', SHA2('password123', 256), 'admin@example.com', 'Admin User', 1),
('staff1', SHA2('password123', 256), 'staff1@example.com', 'Staff One', 2),
('customer1', SHA2('password123', 256), 'customer1@example.com', 'Customer One', 3);

-- 2. Insert additional users
INSERT INTO Users (Username, PasswordHash, Email, FullName, RoleID) VALUES
('staff2', SHA2('password123', 256), 'staff2@example.com', 'Staff Two', 2),
('staff3', SHA2('password123', 256), 'staff3@example.com', 'Staff Three', 2),
('customer2', SHA2('password123', 256), 'customer2@example.com', 'Customer Two', 3),
('customer3', SHA2('password123', 256), 'customer3@example.com', 'Customer Three', 3);

-- 3. Insert sample categories
INSERT INTO Categories (CategoryName, Description) VALUES
('Appetizers', 'Start your meal with our delicious appetizers.'),
('Main Course', 'Hearty and fulfilling main dishes.'),
('Desserts', 'Sweet treats to end your meal.');

-- 4. Insert additional categories
INSERT INTO Categories (CategoryName, Description) VALUES
('Beverages', 'Refreshing drinks and beverages.'),
('Salads', 'Healthy and fresh salads.');

-- 5. Insert sample menu items
INSERT INTO MenuItems (CategoryID, Name, Description, Price) VALUES
(1, 'Spring Rolls', 'Crispy vegetable spring rolls.', 5.99),
(2, 'Grilled Salmon', 'Freshly grilled salmon with herbs.', 15.99),
(3, 'Cheesecake', 'Creamy cheesecake with a graham cracker crust.', 6.50);

-- 6. Insert additional menu items
INSERT INTO MenuItems (CategoryID, Name, Description, Price) VALUES
(4, 'Lemonade', 'Freshly squeezed lemonade.', 2.99),
(4, 'Iced Tea', 'Chilled black iced tea.', 2.50),
(5, 'Caesar Salad', 'Classic Caesar with croutons.', 7.99),
(5, 'Greek Salad', 'Salad with feta cheese and olives.', 8.50),
(2, 'Steak', 'Grilled ribeye steak.', 20.00),
(3, 'Brownie', 'Chocolate brownie with nuts.', 5.00),
(3, 'Ice Cream', 'Vanilla ice cream scoop.', 3.50);

-- 7. Insert sample tables
INSERT INTO Tables (TableNumber, Capacity) VALUES
(1, 4),
(2, 2),
(3, 6);

-- 8. Insert additional tables
INSERT INTO Tables (TableNumber, Capacity) VALUES
(4, 4),
(5, 2),
(6, 8),
(7, 10);

-- 9. Insert sample inventory items
INSERT INTO Inventory (ItemName, Quantity, Unit, ReorderLevel) VALUES
('Flour', 50, 'kg', 10),
('Sugar', 30, 'kg', 10),
('Salmon Fillet', 20, 'pieces', 5);

-- 10. Insert additional inventory items
INSERT INTO Inventory (ItemName, Quantity, Unit, ReorderLevel) VALUES
('Tomatoes', 100, 'kg', 20),
('Lettuce', 80, 'kg', 15),
('Olives', 50, 'kg', 10),
('Cheddar Cheese', 40, 'kg', 10),
('Bacon', 60, 'pieces', 15),
('Tea Leaves', 30, 'kg', 5),
('Lemons', 200, 'pieces', 50);

-- 11. Insert sample reservations (including edge cases)
-- Successful reservations
INSERT INTO Reservations (UserID, TableID, ReservationTime, NumberOfGuests, Status) VALUES
(3, 1, '2025-01-10 18:00:00', 4, 'Confirmed'),
(4, 2, '2025-01-10 19:00:00', 2, 'Confirmed'),
(5, 3, '2025-01-11 20:00:00', 6, 'Pending');

-- Attempt overlapping reservation (should be blocked by trigger)
-- Uncomment to test trigger
-- INSERT INTO Reservations (UserID, TableID, ReservationTime, NumberOfGuests, Status) VALUES
-- (6, 1, '2025-01-10 19:00:00', 3, 'Confirmed');

-- 12. Insert sample orders
INSERT INTO Orders (UserID, TableID, OrderTime, Status, TotalAmount) VALUES
(3, 1, '2025-01-10 18:15:00', 'Pending', 0.00),
(4, 2, '2025-01-10 19:05:00', 'In Progress', 0.00),
(5, 3, '2025-01-11 20:10:00', 'Pending', 0.00);

-- 13. Insert additional order items
INSERT INTO OrderItems (OrderID, MenuItemID, Quantity, Price) VALUES
(1, 1, 2, 5.99),  -- Spring Rolls x2
(1, 2, 1, 15.99), -- Grilled Salmon x1
(1, 4, 3, 2.99),  -- Lemonade x3
(2, 5, 2, 7.99),  -- Caesar Salad x2
(2, 6, 1, 20.00), -- Steak x1
(3, 7, 4, 3.50);  -- Ice Cream x4

-- 14. Insert sample payments
INSERT INTO Payments (OrderID, PaymentMethod, PaymentStatus, Amount, TransactionID) VALUES
(1, 'Credit Card', 'Completed', 5.99*2 + 15.99*1 + 2.99*3, 'TXN123456'),
(2, 'PayPal', 'Completed', 7.99*2 + 20.00*1, 'TXN123457'),
(3, 'Cash', 'Pending', 3.50*4, NULL);

-- 15. Insert additional employee schedules
INSERT INTO EmployeeSchedules (UserID, ShiftDate, ShiftStart, ShiftEnd) VALUES
(2, '2025-01-10', '09:00:00', '17:00:00'),
(3, '2025-01-10', '12:00:00', '20:00:00'),
(4, '2025-01-11', '10:00:00', '18:00:00'),
(5, '2025-01-11', '14:00:00', '22:00:00');

-- 16. Insert additional feedback (including edge cases)
INSERT INTO Feedback (UserID, OrderID, Rating, Comments) VALUES
(3, 1, 5, 'Excellent service and food!'),
(4, 2, 4, 'Great meals but the steak was a bit overcooked.'),
(5, 3, 3, 'Average experience. Could be better.');

-- Attempt invalid feedback rating (should be blocked by CHECK constraint)
-- Uncomment to test constraint
-- INSERT INTO Feedback (UserID, OrderID, Rating, Comments) VALUES
-- (6, 4, 6, 'Invalid rating test.');

-- 17. Insert inventory adjustments (simulate usage)
UPDATE Inventory SET Quantity = Quantity - 2 WHERE ItemName = 'Flour';        -- Flour used
UPDATE Inventory SET Quantity = Quantity - 1 WHERE ItemName = 'Sugar';        -- Sugar used
UPDATE Inventory SET Quantity = Quantity - 5 WHERE ItemName = 'Salmon Fillet'; -- Salmon used
UPDATE Inventory SET Quantity = Quantity - 20 WHERE ItemName = 'Lemons';      -- Lemons used

-- Attempt to reduce inventory below zero (should be blocked by trigger)
-- Uncomment to test trigger
-- UPDATE Inventory SET Quantity = Quantity - 100 WHERE ItemName = 'Olives';
