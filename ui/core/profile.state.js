import { $State } from '../../core/state.js'

const API_URL = '/hoa_system/app/api/users/get.boardmembers.php'

const profileState = $State({
  user: null,
  loading: true,
  editMode: {
    personal: false,
    home: false,
    account: false
  }
})

$(document).on('change:user.profileState change:loading.profileState', () => {
  renderProfile()
})