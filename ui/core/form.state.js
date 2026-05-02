class FormState {
  constructor(config) {
    this.c = {
      formId: '',
      apiUrl: '',
      saveUrl: '',
      idParam: 'id',
      onLoading: () => {},
      onLoaded: () => {},
      onSaving: () => {},
      onSaved: () => {},
      onError: () => {},
      ...config
    }
    this.state = { data: {}, loading: false, saving: false }
    this.init()
  }

  init() {
    this.loadRecord()
  }

  toggleEditable(e) {
    e.preventDefault()

    const isReadonly = !$('form').data('editable')
    if (isReadonly) {
      $('form').find('input, select, textarea').prop('readonly', false).prop('disabled', false)
      $(`#${this.c.formId} button[type="submit"]`).removeClass('hidden')
      $(e.target).text('Cancel').prepend('<i class="ri-close-large-line"></i>')
    } else {
      $('form').find('input, select, textarea').prop('readonly', true).prop('disabled', true)
      $(`#${this.c.formId} button[type="submit"]`).addClass('hidden')
      $(e.target).html('<i class="ri-edit-box-line"></i> Edit')
    }

    $('form').data('editable', isReadonly)
  }

  getId() {
    const p = new URLSearchParams(window.location.search)
    return p.get(this.c.idParam) || null
  }

async loadRecord() {
  const id = this.getId()
  if (!id) return

  this.state.loading = true
  this.c.onLoading?.()

  const url = this.c.apiUrl

  try {
    const res = await $.ajax({
      url: url,
      type: 'GET',
      data: { [this.c.idParam]: id },
      dataType: 'json',
      success: (response) => {
        if (response.success) {
          this.state.data = response.data || {}
          this.populateForm()
        } else {
          console.error(response.error || 'Failed to fetch record')
        }
      },
      error: (xhr, status, error) => {
        console.error("Error fetching data:", error) 
      }
    })
  } catch (err) {
    console.error("AJAX request failed:", err) 
  } finally {
    this.state.loading = false
    this.c.onLoaded?.()
  }
}

  populateForm() {
    const $form = $(`#${this.c.formId}`)
    if (!$form.length) return

    Object.entries(this.state.data).forEach(([key, value]) => {
      const $el = $form.find(`[name="${key}"]`)
      if ($el.length) {
        if ($el.is(':checkbox')) {
          $el.prop('checked', !!value)
        } else if ($el.is('select')) {
          $el.val(value).trigger('change')
        } else if ($el.is('input[type="date"]')) {
          const dateValue = value ? new Date(value) : null
          if (dateValue && !isNaN(dateValue)) {
            const formattedDate = dateValue.toISOString().split('T')[0]
            $el.val(formattedDate)
          } else {
            $el.val('')
          }
        } else {
          $el.val(value ?? '')
        }
      }
    })
  }

  getFormData() {
    const $form = $(`#${this.c.formId}`)
    const formData = {}

    $form.serializeArray().forEach(field => {
      formData[field.name] = field.value
    })

    return formData
  }

  async save() {
    this.c.onSaving?.()

    const formData = this.getFormData()

    try {
      const res = await $.ajax({
        url: this.c.saveUrl,
        type: 'POST',
        data: formData, 
        dataType: 'json',
        success: (response) => {
          if (response.success) {
            this.c.onSaved?.(response)
          } else {
            this.c.onError?.(response.error || 'Unknown error')
          }
        },
        error: (xhr, status, error) => {
          this.c.onError?.(error || 'Error occurred during saving')
        }
      })
    } catch (err) {
      this.c.onError?.(err || 'Error occurred during saving')
    }
  }
}
