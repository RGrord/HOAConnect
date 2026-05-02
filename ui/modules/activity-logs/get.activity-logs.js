import { $State } from "../../core/state.js";
import { DataFetcher } from "../../core/data-fetch.js";
import { TableView } from "../../core/table-view.js";
import { showToast } from "../../utils/toast.js";

const BASE_URL = "/hoa_system/";
const API_URL = `${BASE_URL}app/api/activity-logs/get.activity-logs.php`;

const $state = $State({
  search: "",
  pagination: {
    currentPage: 1,
    limit: 10,
    totalPages: 0,
    totalRecords: 0,
  },
  data: [],
  loading: false,
});

const fetcher = new DataFetcher($state, API_URL);

const columns = [
  row => `
    <div>
      <div class="font-semibold text-gray-800">${row.action}</div>
    </div>
  `,
  row => `
    <div>
      <div class="font-semibold text-gray-800">${row.full_name || "Unknown User"}</div>
    </div>
  `,

  row => `<span class="text-gray-700">${row.ip_address || "—"}</span>`,

  row => `
    <span class="text-gray-600 text-xs">
      ${row.user_agent?.substring(0, 50) || "—"}${row.user_agent?.length > 50 ? "..." : ""}
    </span>
  `,

  row => `
    <span class="text-gray-700">
      ${new Date(row.created_at).toLocaleString("en-PH")}
    </span>
  `
];

// Attach TableView
new TableView($state, fetcher, {
  tableId: "dataTable",
  searchId: "simple-search",
  paginationId: "paginationList",
  columns
});

// Error Handling
$(document).on("fetch:error", (e, msg) =>
  showToast(msg || "Failed to load activity logs.", "error")
);
