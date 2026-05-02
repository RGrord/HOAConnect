export const $State = function(initial = {}) {
  const $state = $({})
  let raw = {
    data: [],
    loading: false,
    search: '',
    pagination: { currentPage: 1, totalPages: 1, totalRecords: 0, limit: 10 },
    ...initial
  }

  $state.val = function(key, value) {
    if (arguments.length === 0) return raw
    if (arguments.length === 1) return raw[key]

    const oldValue = raw[key]
    raw[key] = value

    $(document).trigger('change', [key, value])
    $(document).trigger(`change:${key}`, [value])

    return $state
  }

  $state.search = function(term) {
    return $state.val('search', term || '').val('pagination', {
      ...$state.val('pagination'), currentPage: 1
    })
  }

  $state.page = function(page) {
    const p = $state.val('pagination')
    if (page >= 1 && page <= p.totalPages) {
      return $state.val('pagination', { ...p, currentPage: page })
    }
    return $state
  }

  $state.loading = function(bool) { return $state.val('loading', !!bool) }
  $state.updateData = function({ data, pagination }) {
  if (data !== undefined) {
    $state.val('data', data)
  }
  if (pagination) {
    const current = $state.val('pagination')
    $state.val('pagination', { ...current, ...pagination })
  }
  return $state
}
  return $state
}