import { showToast } from '/hoa_system/ui/utils/toast.js'

const state = {
  loading: false,
  error: '',
  success: '',

  set(newState) {
    Object.assign(this, newState)
    render()
  }
}

$(document).ready(function () {
  const $form = $('#login-form')
  const $username = $('#username')
  const $password = $('#password')

  $username.on('input', () => clearError($username))
  $password.on('input', () => clearError($password))

  $form.on('submit', function (e) {
    e.preventDefault()

    const username = $username.val().trim()
    const password = $password.val().trim()

    if (!username || !password) {
      showToast({
        message: 'Please fill in both fields.',
        type: 'error',
        position: 'bottom-right'
      })
      state.set({ error: 'Missing credentials' })
      return
    }

    handleLogin(username, password)
  })
})

function handleLogin(username, password) {
  state.set({ loading: true, error: '' })

  $.ajax({
    url: '/hoa_system/app/api/auth/login.php',
    type: 'POST',
    data: { username, password },
    dataType: 'json',
    timeout: 10000, 

    success: function (res) {
      if (!res || typeof res !== 'object') {
        fail('Invalid response from server')
        return
      }

      if (res.success) {
        showToast({
          message: 'Welcome back!',
          type: 'success',
          position: 'center',
          duration: 2000
        })

        const redirectTo = res.firstTime
          ? '/hoa_system/public/auth/setup.php'
          : '/hoa_system/pages/dashboard/index.php'

        setTimeout(() => {
          window.location.href = redirectTo
        }, 1300)

      } else {
        showToast({
          message: res.message || 'Invalid credentials',
          type: 'error',
          position: 'center'
        })
        state.set({ error: res.message || 'Login failed' })
      }
    },

    error: function (xhr, status, err) {
      let message = 'Network error. Please try again.'

      if (status === 'timeout') message = 'Request timed out. Check your connection.'
      if (!navigator.onLine) message = 'No internet connection.'

      showToast({
        message,
        type: 'error',
        position: 'center'
      })

      state.set({ loading: false, error: message })
    },

    complete: function () {
      state.set({ loading: false })
    }
  })
}

function render() {
  const $btn = $('#loginBtn')
  const $icon = $btn.find('svg')
  
  if (state.loading) {
    $btn.prop('disabled', true)
    $btn.html(`
      <svg class="inline w-4 h-4 text-gray-200 animate-spin fill-teal-600 me-3" viewBox="0 0 100 101" xmlns="http://www.w3.org/2000/svg">
        <path d="M100 50.59C100 78.2 77.61 100.59 50 100.59C22.38 100.59 0 78.2 0 50.59C0 22.97 22.38 0.59 50 0.59C77.61 0.59 100 22.97 100 50.59Z" fill="currentColor" opacity="0.3"/>
        <path d="M93.97 39.04C96.39 38.4 97.86 35.91 97.01 33.55C95.29 28.82 92.87 24.37 89.82 20.35C85.85 15.12 80.88 10.72 75.21 7.41C69.54 4.1 63.27 1.94 56.77 1.05C51.77 0.36 46.7 0.44 41.73 1.27C39.26 1.69 37.81 4.19 38.45 6.62C39.09 9.05 41.57 10.47 44.05 10.11C47.85 9.55 51.72 9.53 55.54 10.05C60.86 10.78 65.99 12.55 70.63 15.25C75.27 17.96 79.33 21.56 82.58 25.84C84.92 28.91 86.8 32.29 88.18 35.88C89.08 38.21 91.54 39.68 93.97 39.04Z" fill="currentFill"/>
      </svg>
      Logging in...
    `)
  } else {
    $btn.prop('disabled', false).html('Log in')
  }
}

function clearError($input) {
  $input.removeClass('border-red-500 focus:ring-red-500')
}

function fail(message) {
  state.set({ loading: false })
  showToast({ message, type: 'error', position: 'bottom-right' })
}