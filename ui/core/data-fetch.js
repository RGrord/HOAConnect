export class DataFetcher {
  constructor($state, apiUrl) {
    this.$s = $state;
    this.apiUrl = apiUrl;
  }

  fetch() {
    const { currentPage, limit } = this.$s.val('pagination');
    const search = this.$s.val('search').trim();

    this.$s.loading(true);

    return $.get(this.apiUrl, { page: currentPage, limit, search })
      .done(res => {
        if (res.success) {
          this.$s.updateData({ data: res.data, pagination: res.pagination });
        } else {
          this.$s.updateData({ data: [] });
        }
      })
      .fail(() => {
        this.$s.updateData({ data: [] });
      })
      .always(() => {
        this.$s.loading(false);
      });
  }

  save(data, id = null) {
    const url = id ? `${this.apiUrl}/${id}` : this.apiUrl;
    const type = id ? 'PUT' : 'POST';
    return $.ajax({ url, type, data }).then(() => this.fetch());
  }
}