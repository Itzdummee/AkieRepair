<style>
    .global-toast {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10000;
        background: #15803d; /* Tailwind green-700 */
        color: #fff;
        padding: 14px 28px;
        border-radius: 8px;
        font-family: 'Mukta Mahee', sans-serif;
        font-size: 16px;
        font-weight: 600;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        display: flex;
        align-items: center;
        gap: 12px;
        animation: slideDownToast 0.4s ease-out forwards;
    }

    .global-toast.error {
        background: #dc2626; /* Tailwind red-600 */
    }

    @keyframes slideDownToast {
        from { top: -50px; opacity: 0; }
        to { top: 20px; opacity: 1; }
    }
    
    @keyframes fadeOutToast {
        from { opacity: 1; transform: translateX(-50%) translateY(-20px); }
        to { opacity: 0; transform: translateX(-50%) translateY(-20px); visibility: hidden; }
    }
</style>

@if(session('success'))
<div class="global-toast" id="globalToast">
    <i class="bi bi-check-circle-fill" style="font-size: 20px;"></i>
    <span>{{ session('success') }}</span>
</div>
@endif

@if(session('error'))
<div class="global-toast error" id="globalToastError">
    <i class="bi bi-exclamation-triangle-fill" style="font-size: 20px;"></i>
    <span>{{ session('error') }}</span>
</div>
@endif

<script>
    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(function() {
            let toast = document.getElementById('globalToast');
            if (toast) {
                toast.style.animation = 'fadeOutToast 0.5s forwards';
                setTimeout(() => toast.remove(), 500);
            }
            let toastError = document.getElementById('globalToastError');
            if (toastError) {
                toastError.style.animation = 'fadeOutToast 0.5s forwards';
                setTimeout(() => toastError.remove(), 500);
            }
        }, 3000); // Popup stays for 3 seconds before disappearing
    });
</script>
