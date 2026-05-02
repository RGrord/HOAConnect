$(document).ready(function() {
  let $start = $("input[name='date_start']")
  let $end = $("input[name='date_end']")
  $end.on('change', function() {
    dateValidity($start.val(), $(this).val())
  })
})


function dateValidity($start, $end) {
  if(new Date($start) > new Date($end)) {
    console.log($start)
  }
}