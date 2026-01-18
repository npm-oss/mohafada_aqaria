(function () {
    // Styles for the modal
    const modalStyles = `
        .custom-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            backdrop-filter: blur(4px);
        }

        .custom-modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .custom-modal-box {
            background: white;
            border-radius: 16px;
            padding: 24px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transform: scale(0.9);
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            text-align: center;
            font-family: 'Tajawal', 'Cairo', sans-serif;
        }

        .custom-modal-overlay.active .custom-modal-box {
            transform: scale(1);
        }

        .custom-modal-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin: 0 auto 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
        }

        .custom-modal-icon.success { background: #dcfce7; color: #16a34a; }
        .custom-modal-icon.error { background: #fee2e2; color: #dc2626; }
        .custom-modal-icon.warning { background: #fef3c7; color: #d97706; }
        .custom-modal-icon.info { background: #e0e7ff; color: #4f46e5; }

        .custom-modal-title {
            font-size: 20px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .custom-modal-message {
            font-size: 16px;
            color: #6b7280;
            margin-bottom: 24px;
            line-height: 1.5;
        }

        .custom-modal-btn {
            background: #4f46e5;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: background 0.2s;
            font-family: inherit;
        }

        .custom-modal-btn:hover {
            background: #4338ca;
        }
        
        .custom-modal-btn.error { background: #dc2626; }
        .custom-modal-btn.error:hover { background: #b91c1c; }
    `;

    // Inject styles
    const styleSheet = document.createElement("style");
    styleSheet.innerText = modalStyles;
    document.head.appendChild(styleSheet);

    // Create Modal HTML
    const modalHTML = `
        <div class="custom-modal-overlay" id="customModal">
            <div class="custom-modal-box">
                <div class="custom-modal-icon" id="customModalIcon">✓</div>
                <div class="custom-modal-title" id="customModalTitle">عنوان</div>
                <div class="custom-modal-message" id="customModalMessage">الرسالة هنا</div>
                <button class="custom-modal-btn" id="customModalBtn">موافق</button>
            </div>
        </div>
    `;

    // Inject HTML
    const div = document.createElement('div');
    div.innerHTML = modalHTML;
    document.body.appendChild(div.firstElementChild);

    // Elements
    const modal = document.getElementById('customModal');
    const iconEl = document.getElementById('customModalIcon');
    const titleEl = document.getElementById('customModalTitle');
    const msgEl = document.getElementById('customModalMessage');
    const btnEl = document.getElementById('customModalBtn');

    // Close function
    function closeModal() {
        modal.classList.remove('active');
    }

    btnEl.addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    // Icons map
    const icons = {
        success: '✓',
        error: '✕',
        warning: '!',
        info: 'ℹ'
    };

    // Public function
    window.showModal = function (message, type = 'info', title = '') {
        // Determine type based on message content if not specified strictly
        if (!title) {
            if (type === 'success' || message.includes('نجاح') || message.includes('تم')) {
                type = 'success';
                title = 'تمت العملية بنجاح';
            } else if (type === 'error' || message.includes('خطأ') || message.includes('فشل')) {
                type = 'error';
                title = 'حدث خطأ';
            } else if (type === 'warning' || message.includes('تنبيه') || message.includes('تحذير')) {
                type = 'warning';
                title = 'تنبيه';
            } else {
                title = 'معلومات';
            }
        }

        // Set content
        msgEl.textContent = message;
        titleEl.textContent = title;
        iconEl.textContent = icons[type] || icons.info;

        // Reset classes
        iconEl.className = 'custom-modal-icon ' + type;
        btnEl.className = 'custom-modal-btn ' + (type === 'error' ? 'error' : '');

        // Show
        modal.classList.add('active');

        // Focus button
        setTimeout(() => btnEl.focus(), 100);
    };

    // Override generic alert if wanted, but safest to use explicit calls first.
    // window.alert = function(msg) { window.showModal(msg); } 
})();
