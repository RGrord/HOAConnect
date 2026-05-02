export function mobileNumberOnly(selector) {
  $(document).on("keypress", selector, function (e) {
    const key = e.key;

    if (!/^[0-9]$/.test(key)) {
      e.preventDefault();
    }

    if (this.value.length >= 11) {
      e.preventDefault();
    }
  });

  $(document).on("input", selector, function () {
    this.value = this.value.replace(/[^0-9]/g, "");
    if (this.value.length > 11) {
      this.value = this.value.slice(0, 11);
    }
  });
}
