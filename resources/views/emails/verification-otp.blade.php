@component('mail::message')
# Verification Code

<div style="text-align: center; background-color: #f8f9fa; padding: 20px; margin: 20px 0; border-radius: 8px;">
    <span style="font-size: 32px; font-weight: bold; letter-spacing: 3px; color: #333;">{{ $otp }}</span>
</div>

@endcomponent