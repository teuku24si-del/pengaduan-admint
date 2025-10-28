 <footer class="footer">
                    <div class="footer-inner-wraper">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                                bootstrapdash.com 2020</span>
                            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                                    href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard
                                    templates</a> from Bootstrapdash.com</span>
                        </div>
                    </div>
                </footer>

                <!-- Floating WhatsApp Button -->
    <div class="floating-whatsapp-footer">
        <button class="whatsapp-btn-footer" onclick="redirectToWhatsApp()">
            <i class="mdi mdi-whatsapp"></i>
        </button>
        <div class="whatsapp-tooltip-footer">
            Hubungi via WhatsApp
        </div>
    </div>
</footer>

<style>
/* Floating WhatsApp Button Styles */
.floating-whatsapp-footer {
    position: fixed;
    bottom: 80px;
    right: 25px;
    z-index: 1000;
}

.whatsapp-btn-footer {
    width: 60px;
    height: 60px;
    background: #25D366;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
    cursor: pointer;
    transition: all 0.3s ease;
    border: none;
    animation: pulse-whatsapp 2s infinite;
}

.whatsapp-btn-footer:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 25px rgba(37, 211, 102, 0.6);
    background: #1da851;
}

.whatsapp-btn-footer i {
    font-size: 28px;
    color: white;
}

.whatsapp-tooltip-footer {
    position: absolute;
    bottom: 70px;
    right: 0;
    background: white;
    padding: 10px 15px;
    border-radius: 25px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    font-size: 14px;
    font-weight: 500;
    color: #2c3e50;
    white-space: nowrap;
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.3s ease;
    pointer-events: none;
    border: 1px solid #e0e0e0;
}

.whatsapp-btn-footer:hover + .whatsapp-tooltip-footer {
    opacity: 1;
    transform: translateY(0);
}

@keyframes pulse-whatsapp {
    0% {
        box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
    }
    50% {
        box-shadow: 0 4px 25px rgba(37, 211, 102, 0.7);
    }
    100% {
        box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .floating-whatsapp-footer {
        bottom: 70px;
        right: 20px;
    }

    .whatsapp-btn-footer {
        width: 55px;
        height: 55px;
    }

    .whatsapp-btn-footer i {
        font-size: 24px;
    }

    .whatsapp-tooltip-footer {
        font-size: 12px;
        padding: 8px 12px;
        bottom: 65px;
    }
}

@media (max-width: 576px) {
    .floating-whatsapp-footer {
        bottom: 60px;
        right: 15px;
    }

    .whatsapp-btn-footer {
        width: 50px;
        height: 50px;
    }

    .whatsapp-btn-footer i {
        font-size: 22px;
    }

    .whatsapp-tooltip-footer {
        font-size: 11px;
        padding: 6px 10px;
        bottom: 60px;
    }
}

/* Ensure footer has proper positioning */
.footer {
    position: relative;
}
</style>

<script>
function redirectToWhatsApp() {
    // Konfigurasi nomor telepon dan pesan
    const phoneNumber = "6281234567890"; // Ganti dengan nomor WhatsApp admin
    const defaultMessage = "Halo Admin, saya ingin bertanya mengenai informasi dari website Bina Desa.";

    // Encode pesan untuk URL
    const encodedMessage = encodeURIComponent(defaultMessage);

    // Redirect ke WhatsApp
    window.open(`https://wa.me/${phoneNumber}?text=${encodedMessage}`, '_blank');

    // Optional: Tracking click (jika menggunakan analytics)
    console.log('WhatsApp button clicked - Redirecting to:', phoneNumber);
}

// Optional: Auto show tooltip for first-time visitors
document.addEventListener('DOMContentLoaded', function() {
    const tooltip = document.querySelector('.whatsapp-tooltip-footer');

    // Cek jika ini kunjungan pertama
    if (!localStorage.getItem('whatsappTooltipShown')) {
        tooltip.style.opacity = '1';
        tooltip.style.transform = 'translateY(0)';

        setTimeout(() => {
            tooltip.style.opacity = '0';
            tooltip.style.transform = 'translateY(10px)';
        }, 4000);

        localStorage.setItem('whatsappTooltipShown', 'true');
    }
});

// Optional: Add click animation
document.querySelector('.whatsapp-btn-footer').addEventListener('click', function(e) {
    e.target.style.transform = 'scale(0.9)';
    setTimeout(() => {
        e.target.style.transform = 'scale(1)';
    }, 150);
});
</script>
