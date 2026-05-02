export function lettersOnly(selector) {
  $(document).on("keypress", selector, function (e) {
    if (!/^[a-zA-Z]$/.test(e.key)) {
      e.preventDefault();
    }
  });

  $(document).on("input", selector, function () {
    this.value = this.value.replace(/[^a-zA-Z]/g, "");
  });
}
