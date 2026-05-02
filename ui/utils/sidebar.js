$(document).ready(function() {
  const $sidebarList = $('#sidebarList')
  const $sidebarToggle = $('#sidebarToggle')
  const $sidebar = $('#sidebar')

  $sidebarToggle.on('click', function() {
      if ($sidebar.is(':visible')) {
          $sidebar.animate({ width: '0px', opacity: 0 }, 100, function() {
              $sidebar.hide()
          })
      } else {
          $sidebar.show().css({ width: '0px', opacity: 0 })
                  .animate({ width: '16rem', opacity: 1 }, 100)
      }

      $sidebarToggle.html(
          $sidebar.is(':visible') ? '<i class="ri-menu-2-fill"></i>' : '<i class="ri-menu-fill"></i>'
      )
  })

  $.ajax({
      url: '/hoa_system/app/helpers/sidebar.php',
      method: 'GET',
      dataType: 'json',
      success: function(data) {
          if (data.error) {
              $sidebarList.html('<p class="text-red-500">Error loading sidebar</p>')
              return
          }

          const html = buildSidebarHtml(data)
          $sidebarList.html(html)

          $('[data-collapse-toggle]').on('click', function() {
              const targetId = $(this).data('collapse-toggle')
              const $target = $(`#${targetId}`)
              $('[id^="submenu-"]').not($target).slideUp(200)
              $target.slideToggle(200)
          })

          highlightActiveSidebar()
      },
      error: function() {
          $sidebarList.html('<p class="text-red-500">Failed to load sidebar</p>')
      }
  })

  function buildSidebarHtml(items) {
    let html = '<ul class="space-y-2">'
    items.forEach((item, index) => {
      if (item.submenu && item.submenu.length) {
        html += `
        <li>
          <button type="button" class="flex items-center w-full py-2 px-3 font-normal rounded-lg transition hover:bg-teal-700 hover:text-gray-50"
            data-collapse-toggle="submenu-${index}">
            <i class="${item.icon} mr-3"></i>
            <span class="flex-1 text-left">${item.label}</span>
            <svg class="w-6 h-6 rotate-0 transition-all" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.06z"></path>
            </svg>
          </button>
          <ul id="submenu-${index}" class="hidden py-2 space-y-2">
            ${item.submenu.map(sub => `
              <li class="px-4">
                <a href="${sub.url || '#'}" class="flex items-center w-full py-1 px-3 text-sm rounded-lg hover:text-gray-400">
                  ${sub.label}
                </a>
              </li>
            `).join('')}
          </ul>
        </li>`
      }

      else {
        html += `
        <li>
          <a href="${item.url || '#'}"
            class="flex items-center w-full py-2 px-3 font-normal rounded-lg hover:bg-teal-700 hover:text-gray-50">
            <i class="${item.icon} mr-3"></i>
            <span>${item.label}</span>
          </a>
        </li>`
      }
    })
    html += '</ul>'
    return html
  }

  function highlightActiveSidebar() {
    const currentPath = window.location.pathname

    $sidebarList.find('a').each(function() {
      const linkPath = new URL(this.href).pathname
      const folderPath = linkPath.replace(/\/[^\/]+$/, '/')
      if (currentPath.startsWith(folderPath)) {
        $(this).addClass('!bg-white !text-teal-700 font-semibold shadow rounded')
        const $parentUl = $(this).closest('ul[id^="submenu-"]')
        if ($parentUl.length) {
          $parentUl.show()
          $parentUl.prev("button")
              .addClass("!bg-teal-700 !text-white font-semibold")
        }
      }
    })
  }
})
