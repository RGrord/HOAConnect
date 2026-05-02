export class TableView {
  constructor($state, fetcher, config) {
    this.$s = $state
    this.fetcher = fetcher
    this.c = $.extend({
      tableId: 'dataTable',
      searchId: 'simple-search',
      paginationId: 'paginationList',
      columns: []
    }, config)
    this.debounceTimer = null
    this.init()
  }

  init() {
  const view = this

  this.bind()
  this.loadUrl()

  this.fetcher.fetch()

  $(document).on('change:data.state change:loading.state', () => {
    view.render()
  })
}

  loadUrl() {
    const p = new URLSearchParams(location.search)
    this.$s.search(p.get('search') || '').page(+(p.get('page')) || 1)
    $(`#${this.c.searchId}`).val(this.$s.val('search'))
  }

  updateUrl() {
    const p = new URLSearchParams()
    const { currentPage } = this.$s.val('pagination')
    const search = this.$s.val('search').trim()

    if (currentPage > 1) p.set('page', currentPage)
    if (search) p.set('search', search)

    const query = p.toString()
    history.replaceState(null, '', query ? '?' + query : location.pathname)
  }

  bind() {
    const searchInput = `#${this.c.searchId}`
    const pagination = `#${this.c.paginationId}`
    const ns = '.tv' + this.c.tableId

    $(document).off('input' + ns).off('click' + ns)

    $(document).on('input' + ns, searchInput, () => {
      clearTimeout(this.debounceTimer)
      this.debounceTimer = setTimeout(() => {
        const val = $(searchInput).val().trim()
        this.$s.search(val)
        this.updateUrl()
        this.fetcher.fetch()
      }, 300)
    })

    $(document).on('click' + ns, `${pagination} .page-btn`, (e) => {
      e.preventDefault()
      const page = +$(e.currentTarget).data('page')
      if (page >= 1 && page <= this.$s.val('pagination').totalPages) {
        this.$s.page(page)
        this.updateUrl()
        this.fetcher.fetch()
      }
    })
  }

  render() {
    const data = this.$s.val('data')
    const loading = this.$s.val('loading')
    const $tbody = $(`#${this.c.tableId} tbody`).empty()
    const $pg = $(`#${this.c.paginationId}`).empty()

    if (loading) return this.showSkeleton($tbody)
    if (!data.length) {
      $tbody.append(`<tr><td colspan="${this.c.columns.length}" class="text-center py-8 text-gray-500">No records found.</td></tr>`);
      return
    }

      data.forEach(row => {
      const cellContents = this.c.columns.map(col => {
        const content = col(row);
        return {
          html: content,
          empty: !content || content.toString().trim() === ''
        };
      });

      let trHtml = '<tr class="border-b hover:bg-gray-50">';
      cellContents.forEach(cell => {
        if (!cell.empty) {
          trHtml += `<td class="px-6 py-4">${cell.html}</td>`;
        }
      });
      trHtml += '</tr>';

      $tbody.append(trHtml);
    });

    this.renderPagination($pg, this.$s.val('pagination'))
  }

  showSkeleton($tbody) {
    const cols = this.c.columns.length
    const rows = this.$s.val('pagination').limit || 10

    const skeletonRow = `
      <tr class="border-b">
        ${Array(cols).fill().map((_, i) => {
          if (i === 0) {
            return `
              <td class="px-6 py-4">
                <div class="flex items-center space-x-3">
                    <div class="h-4 bg-gray-200 rounded w-32 animate-pulse"></div>
                </div>
              </td>`
          }
          if (i === 1 || i === 2) {
            return `<td class="px-6 py-4"><div class="h-6 bg-gray-200 rounded-full w-20 animate-pulse"></div></td>`;
          }
          if (i === cols - 1) {
            return `<td class="px-6 py-4"><div class="h-9 bg-gray-200 rounded-lg w-20 animate-pulse"></div></td>`;
          }
          return `<td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-24 animate-pulse"></div></td>`;
        }).join('')}
      </tr>`

    $tbody.append(Array(rows).fill(skeletonRow).join(''))
  }

  renderPagination($pg, p) {
    if (!p.totalRecords) return;
    const start = (p.currentPage - 1) * p.limit + 1;
    const end = Math.min(start + p.limit - 1, p.totalRecords);
    $('#rangeStart').text(start); $('#rangeEnd').text(end); $('#totalRecords').text(p.totalRecords);

    $pg.append(this.pagBtn(p.currentPage - 1, 'Previous', p.currentPage === 1));
    let s = Math.max(1, p.currentPage - 2), e = Math.min(p.totalPages, s + 4);
    if (e - s + 1 < 5) s = Math.max(1, e - 4);
    for (let i = s; i <= e; i++) $pg.append(this.pagBtn(i, i, i === p.currentPage));
    $pg.append(this.pagBtn(p.currentPage + 1, 'Next', p.currentPage === p.totalPages));
  }

  pagBtn(page, text, disabled) {
    const active = page === this.$s.val('pagination').currentPage;
    const cls = disabled ? 'opacity-50 cursor-not-allowed' : '';
    const style = active ? 'bg-teal-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100';
    const r = text === 'Previous' ? 'rounded-s-lg' : text === 'Next' ? 'rounded-e-lg' : '';
    return `<li><a href="#" data-page="${page}" class="page-btn px-3 h-8 border ${cls} ${style} ${r} flex items-center justify-center">${text}</a></li>`;
  }
}