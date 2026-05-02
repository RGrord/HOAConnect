import { $State } from '../../core/state.js'
import { DataFetcher } from '../../core/data-fetch.js'
import { showToast } from '../../utils/toast.js'

$(document).ready(function() {
  let currentPage = 1;
  const limit = 5;

  function fetchNews(search = '', page = 1) {
    $.ajax({
      url: '/hoa_system/app/api/news-feed/get.news-feed.php',
      type: 'GET',
      data: { search, page, limit },
      dataType: 'json',
      success: function(res) {
        if (res.success) {
          renderNews(res.data);
          updatePagination(res.pagination);
        } else {
          $('#newsfeed-list').html('<p>No posts found.</p>');
          updatePagination({ totalRecords: 0, totalPages: 1, currentPage: 1, limit });
        }
      },
      error: function(xhr) {
        console.error('Error:', xhr.responseText);
        $('#newsfeed-list').html('<p>Error loading posts.</p>');
      }
    });
  }

  function renderNews(posts) {
    const loggedInUserId = $('#loggedInUserId').val();
    if (posts.length === 0) {
      $('#newsfeed-list').html('<p>No posts found.</p>');
      return;
    }
    console.log(loggedInUserId);
    const html = posts.map(post => `
      <div class="newsfeed-item bg-white rounded-lg shadow mb-6">
        <div class="flex items-center px-4 py-3 border-b gap-4">
          <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center text-teal-600 font-bold text-sm">
            ${post.full_name?.charAt(0) || '?'}
          </div>
          <div class="flex-1">
            <p class="font-semibold text-gray-800">${post.full_name}</p>
            <p class="text-gray-500 text-sm">${post.date_created}</p>
          </div>
          ${post.created_by == loggedInUserId ? `
          <button class="btn-edit-post text-blue-500 font-semibold text-sm px-3 py-1 rounded hover:bg-blue-50" 
                  data-post='${JSON.stringify(post)}'>
            Edit
          </button>
          ` : ''}
        </div>
        <div class="px-4 py-5">
          <h3 class="font-bold text-lg mb-2">${post.post_title}</h3>
          <p class="text-gray-700 mb-3">${post.description}</p>
          ${post.post_images ? `<img src="${post.post_images}" class="w-full max-h-80 object-cover rounded-lg mb-3">` : ''}
          ${post.project_file ? `<a href="${post.project_file}" target="_blank" class="bg-gray-200 py-2 px-4 rounded-lg mb-5 items-center hover:bg-gray-300"> <i class="ri-file-line"></i> Download File</a>` : ''}
        </div>
      </div>
    `).join('');



    $('#newsfeed-list').html(html);
  }

  function updatePagination(pagination) {
    const { totalRecords, totalPages, currentPage: cp } = pagination;
    currentPage = cp;

    const rangeStart = (currentPage - 1) * limit + 1;
    let rangeEnd = currentPage * limit;
    if (rangeEnd > totalRecords) rangeEnd = totalRecords;

    $('#rangeStart').text(rangeStart);
    $('#rangeEnd').text(rangeEnd);
    $('#totalRecords').text(totalRecords);

    $('#prev-page').prop('disabled', currentPage === 1);
    $('#next-page').prop('disabled', currentPage >= totalPages);

    const paginationList = $('#paginationList');
    paginationList.empty();
    for (let i = 1; i <= totalPages; i++) {
      const li = $('<li>').addClass('px-2 py-1 border rounded cursor-pointer')
        .text(i)
        .toggleClass('bg-teal-600 text-white', i === currentPage)
        .on('click', () => fetchNews($('#simple-search').val(), i));
      paginationList.append(li);
    }
  }

  $('#prev-page').click(() => fetchNews($('#simple-search').val(), currentPage - 1));
  $('#next-page').click(() => fetchNews($('#simple-search').val(), currentPage + 1));

  $('#simple-search').on('input', function() {
    fetchNews($(this).val(), 1);
  });
  $('#openCreateModal').on('click', function() { 
    $('#createNewsfeedModal').removeClass('hidden').addClass('flex'); 
  });
  $(document).on('click', '.btn-edit-post', function() {
    const post = $(this).data('post');
    $('#edit_post_id').val(post.id);
    $('#edit_post_title').val(post.post_title);
    $('#edit_description').val(post.description);
    $('#editNewsModal').removeClass('hidden');
  });

  $('#closeEditModal').click(() => $('#editNewsModal').addClass('hidden'));
  $('#closeCreateModal, #cancelCreatePost').click(() => $('#createNewsfeedModal').addClass('hidden'));

  $('#createNewsfeedModal').click(function(e) {
    if (e.target === this) $(this).addClass('hidden');
  });

  fetchNews();
});

$('#create-newsfeed-form').on('submit', function(e) {
  e.preventDefault();
  const formData = new FormData(this);

  $.ajax({
    url: '/hoa_system/app/api/news-feed/post.news.php',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function(res) {
      showToast({ message: 'News post created successfully!', type: 'success' });
      setTimeout(() => {
        window.location.reload();
      }, 1500);
      if (res.success) {
        $('#create-newsfeed-form')[0].reset();
        fetchNews();
      }
    },
    error: function(xhr) {
      showToast({ message: xhr.responseText, type: 'error' });
    }
  });
});

$('#edit-news-form').on('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    $.ajax({
      url: '/hoa_system/app/api/news-feed/put.news.php',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(res) {
        if (res.success) {
          showToast({ message: 'Post edited!', type: 'success' });
          setTimeout(() => {
            window.location.reload();
          }, 1500);
          $('#editNewsModal').addClass('hidden');
          loadNewsfeed();
        } else {
          showToast({ message: 'Error: ' . res.message, type: 'success' });

        }
      }
    });
  });