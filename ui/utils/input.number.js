export function numbersOnly(selector) {
  $(document).on("keypress", selector, function (e) {
    if (!/^[0-9]$/.test(e.key)) {
      e.preventDefault()
    }
  });

  $(document).on("input", selector, function () {
    this.value = this.value.replace(/[^0-9]/g, "")
  });
}
