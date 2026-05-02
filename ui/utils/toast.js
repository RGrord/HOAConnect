// ui/utils/toast.js
export function showToast({ 
  message = '', 
  type = 'success', 
  duration = 3000, 
  position = 'top-right' 
}) {
  const existingToast = document.querySelector('.toast-notification');
  if (existingToast) existingToast.remove();

  const toast = document.createElement('div');
  toast.className = `toast-notification fixed z-50 text-white px-6 py-4 rounded-lg shadow-2xl 
    transition-all duration-500 ease-out flex items-center gap-3 font-medium
    ${type === 'success' ? 'bg-green-600' : 
      type === 'error' ? 'bg-red-600' : 
      type === 'warning' ? 'bg-yellow-500 text-gray-900' : 'bg-teal-600'}
    ${getPositionClass(position)}`;

  toast.innerHTML = `
    <i class="ri-${getIcon(type)} text-2xl"></i>
    <span>${message}</span>
  `;

  document.body.appendChild(toast);

  // Enter animation
  requestAnimationFrame(() => {
    toast.style.opacity = '1';
    toast.style.transform = 'translateY(0)';
  });

  // Exit animation
  setTimeout(() => {
    toast.style.opacity = '0';
    toast.style.transform = 'translateY(-20px)';
    setTimeout(() => toast.remove(), 500);
  }, duration);
}

function getPositionClass(position) {
  const pos = {
    'top-left': 'top-5 left-5',
    'top-right': 'top-5 right-5',
    'bottom-left': 'bottom-5 left-5',
    'bottom-right': 'bottom-5 right-5',
    'center': 'left-1/2 -translate-x-1/2'
  };
  return pos[position] || pos['top-right'];
}

function getIcon(type) {
  return {
    success: 'checkbox-circle-fill',
    error: 'error-warning-fill',
    warning: 'alert-fill',
    info: 'information-fill'
  }[type] || 'information-fill';
}