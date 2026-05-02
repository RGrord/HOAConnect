<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/config.php');

$sidebarItems = [
  'Super Admin' => [
    ['label' => 'Dashboard', 'icon' => 'ri-dashboard-fill', 'url' => BASE_URL . 'pages/dashboard/index.php'],

    ['label' => 'User Management', 'icon' => 'ri-shield-user-line', 'submenu' => [
      ['label' => 'All Users',              'icon' => 'ri-user-search-line', 'url' => BASE_URL . 'pages/user-management/all-users/list.php'],
      ['label' => 'Board Members',          'icon' => 'ri-admin-line',       'url' => BASE_URL . 'pages/user-management/board-members/list.php'],
      ['label' => 'Homeowners',             'icon' => 'ri-user-line',        'url' => BASE_URL . 'pages/user-management/homeowners/list.php'],
      ['label' => 'Create User',            'icon' => 'ri-user-add-line',    'url' => BASE_URL . 'pages/user-management/create.php'],
      ['label' => 'Roles & Permissions',    'icon' => 'ri-lock-password-line', 'url' => BASE_URL . 'pages/user-management/roles.php'],
    ]],

    ['label' => 'Finance & Payments', 'icon' => 'ri-money-dollar-circle-line', 'submenu' => [
      ['label' => 'Monthly Dues',           'icon' => 'ri-file-list-line',      'url' => BASE_URL . 'pages/monthly-dues/list.php'],
      ['label' => 'Fees Management',        'icon' => 'ri-bank-card-fill',      'url' => BASE_URL . 'pages/fees/list.php'],
      // ['label' => 'Fee Assignation',        'icon' => 'ri-file-add-line',       'url' => BASE_URL . 'pages/fees/assignations/list.php'],
      ['label' => 'Payment Verification',   'icon' => 'ri-checkbox-line',       'url' => BASE_URL . 'pages/payment/verification/list.php'],
      ['label' => 'Remittance',             'icon' => 'ri-wallet-line',         'url' => BASE_URL . 'pages/remittance/index.php'],
      ['label' => 'Payment History',        'icon' => 'ri-history-line',        'url' => BASE_URL . 'pages/payment-history/list.php'],
    ]],

    ['label' => 'Amenities Management', 'icon' => 'ri-building-2-fill', 'submenu' => [
      ['label' => 'Tricycle',   'icon' => 'ri-bus-line',       'url' => BASE_URL . 'pages/amenities/tricycle/list.php'],
      ['label' => 'Court',      'icon' => 'ri-football-line',  'url' => BASE_URL . 'pages/amenities/court/list.php'],
      ['label' => 'Stall',      'icon' => 'ri-store-3-line',   'url' => BASE_URL . 'pages/amenities/stall/list.php'],
    ]],

    ['label' => 'Governance', 'icon' => 'ri-government-line', 'submenu' => [
      ['label' => 'Resolution',               'icon' => 'ri-file-paper-2-line', 'url' => BASE_URL . 'pages/resolution/list.php'],
      ['label' => 'Liquidation of Expenses',  'icon' => 'ri-money-dollar-box-line', 'url' => BASE_URL . 'pages/liquidation-of-expenses/list.php'],
      // ['label' => 'General Ledger',           'icon' => 'ri-book-line',        'url' => BASE_URL . 'pages/ledger/list.php'],
    ]],

    ['label' => 'Community', 'icon' => 'ri-team-line', 'submenu' => [
      ['label' => 'News Feed',   'icon' => 'ri-news-line',     'url' => BASE_URL . 'pages/news/feed.php'],
      // ['label' => 'Calendar',    'icon' => 'ri-calendar-event-line', 'url' => BASE_URL . 'pages/calendar/index.php'],
    ]],

    ['label' => 'System Settings', 'icon' => 'ri-settings-3-line', 'submenu' => [
      ['label' => 'Audit Logs',         'icon' => 'ri-file-search-line', 'url' => BASE_URL . 'pages/logs/audit.php'],
      ['label' => 'Backup Database',    'icon' => 'ri-database-2-line',  'url' => BASE_URL . 'pages/backup/index.php'],
      ['label' => 'System Config',      'icon' => 'ri-tools-line',       'url' => BASE_URL . 'pages/settings/system.php'],
      ['label' => 'Activity Log',       'icon' => 'ri-history-line',     'url' => BASE_URL . 'pages/logs/activity.php'],
    ]],
  ],

  'President' => [
    ['label' => 'Dashboard', 'icon' => 'ri-dashboard-line', 'url' => BASE_URL . 'pages/dashboard/index.php'],
    ['label' => 'User Management', 'icon' => 'ri-admin-line', 'submenu' => [
      ['label' => 'Board Members', 'icon' => 'ri-admin-line', 'url' => BASE_URL . 'pages/user-management/board-members/list.php'],
      ['label' => 'Homeowners', 'icon' => 'ri-user-line', 'url' => BASE_URL . 'pages/user-management/homeowners/list.php'],
    ]],
    ['label' => 'Fee Type', 'icon' => 'ri-file-list-line', 'url' => BASE_URL . 'pages/fee-type/list.php'],
    ['label' => 'Resolution', 'icon' => 'ri-file-paper-line', 'url' => BASE_URL . 'pages/resolution/list.php'],
    ['label' => 'Liquidation of Expenses', 'icon' => 'ri-money-dollar-box-line', 'url' => BASE_URL . 'pages/liquidation-of-expenses/list.php'],
    // ['label' => 'Ledger', 'icon' => 'ri-book-line', 'url' => BASE_URL . 'pages/ledger/list.php'],
    ['label' => 'Remittance', 'icon' => 'ri-wallet-line', 'url' => BASE_URL . 'pages/remittance/index.php'],
    ['label' => 'Payment History', 'icon' => 'ri-history-line', 'url' => BASE_URL . 'pages/payment-history/list.php'],
    ['label' => 'Amenities', 'icon' => 'ri-building-line', 'submenu' => [
      ['label' => 'Tricycle', 'icon' => 'ri-bus-line', 'url' => BASE_URL . 'pages/amenities/tricycle/list.php'],
      ['label' => 'Court', 'icon' => 'ri-football-line', 'url' => BASE_URL . 'pages/amenities/court/list.php'],
      ['label' => 'Stall', 'icon' => 'ri-store-3-line', 'url' => BASE_URL . 'pages/amenities/stall/list.php'],
    ]],
    ['label' => 'News Feed', 'icon' => 'ri-news-line', 'url' => BASE_URL . 'pages/news/feed.php'],
    ['label' => 'Activity Logs', 'icon' => 'ri-history-line', 'url' => BASE_URL . 'pages/activity-logs/list.php'],
    // ['label' => 'Calendar', 'icon' => 'ri-calendar-line', 'url' => BASE_URL . 'pages/calendar/index.php']
  ],

  'Admin' => [
    ['label' => 'Dashboard', 'icon' => 'ri-dashboard-line', 'url' => BASE_URL . 'pages/dashboard/index.php'],
    ['label' => 'User Management', 'icon' => 'ri-user-settings-line', 'url' => BASE_URL . 'pages/user-management/homeowners/list.php'],
    ['label' => 'Payment', 'icon' => 'ri-wallet-line', 'submenu' => [
        ['label' => 'Fee Type', 'icon' => 'ri-file-list-line', 'url' => BASE_URL . 'pages/fee-type/list.php'],
        ['label' => 'Fee Assignation', 'icon' => 'ri-bank-card-fill', 'url' => BASE_URL . 'pages/fee-assignation/list.php'],
        ['label' => 'Payment Verification', 'icon' => 'ri-checkbox-line', 'url' => BASE_URL . 'pages/payment-verification/list.php'],
        ['label' => 'Remittance', 'icon' => 'ri-wallet-line', 'url' => BASE_URL . 'pages/remittance/index.php'],
        ['label' => 'Payment History', 'icon' => 'ri-history-line', 'url' => BASE_URL . 'pages/payment-history/list.php'],
    ]],
    ['label' => 'Amenities', 'icon' => 'ri-building-line', 'submenu' => [
        ['label' => 'Tricycle', 'icon' => 'ri-bus-line', 'url' => BASE_URL . 'pages/amenities/tricycle/list.php'],
        ['label' => 'Court', 'icon' => 'ri-football-line', 'url' => BASE_URL . 'pages/amenities/court/list.php'],
        ['label' => 'Stall', 'icon' => 'ri-store-3-line', 'url' => BASE_URL . 'pages/amenities/stall/list.php'],
    ]],
    ['label' => 'Resolution', 'icon' => 'ri-file-paper-line', 'url' => BASE_URL . 'pages/resolution/list.php'],
    // ['label' => 'Ledger', 'icon' => 'ri-book-line', 'url' => BASE_URL . 'pages/ledger/list.php'],
    ['label' => 'News Feed', 'icon' => 'ri-news-line', 'url' => BASE_URL . 'pages/news/feed.php'],
    // ['label' => 'Calendar', 'icon' => 'ri-calendar-line', 'url' => BASE_URL . 'pages/calendar/index.php'],
  ],

  'Secretary' => [
    ['label' => 'Dashboard', 'icon' => 'ri-dashboard-line', 'url' => BASE_URL . 'pages/dashboard/index.php'],
    ['label' => 'Resolution', 'icon' => 'ri-file-paper-line', 'url' => BASE_URL . 'pages/resolution/list.php'],
    ['label' => 'News Feed', 'icon' => 'ri-news-line', 'url' => BASE_URL . 'pages/news/feed.php'],
    // ['label' => 'Ledger', 'icon' => 'ri-book-line', 'url' => BASE_URL . 'pages/ledger/list.php'],
    // ['label' => 'Calendar', 'icon' => 'ri-calendar-line', 'url' => BASE_URL . 'pages/calendar/index.php'],
  ],

  'Treasurer' => [
    ['label' => 'Dashboard', 'icon' => 'ri-dashboard-line', 'url' => BASE_URL . 'pages/dashboard/index.php'],
    ['label' => 'Payment History', 'icon' => 'ri-history-line', 'url' => BASE_URL . 'pages/payment-history/list.php'],
    ['label' => 'Remittance', 'icon' => 'ri-wallet-line', 'url' => BASE_URL . 'pages/remittance/index.php'],
    ['label' => 'Amenities', 'icon' => 'ri-building-line', 'submenu' => [
        ['label' => 'Tricycle', 'icon' => 'ri-bus-line', 'url' => BASE_URL . 'pages/amenities/tricycle/list.php'],
        ['label' => 'Court', 'icon' => 'ri-football-line', 'url' => BASE_URL . 'pages/amenities/court/list.php'],
        ['label' => 'Stall', 'icon' => 'ri-store-3-line', 'url' => BASE_URL . 'pages/amenities/stall/list.php'],
    ]],
    ['label' => 'Resolution', 'icon' => 'ri-file-paper-line', 'url' => BASE_URL . 'pages/resolution/list.php'],
    // ['label' => 'Ledger', 'icon' => 'ri-book-line', 'url' => BASE_URL . 'pages/ledger/list.php'],
    ['label' => 'News Feed', 'icon' => 'ri-news-line', 'url' => BASE_URL . 'pages/news/feed.php'],
    // ['label' => 'Calendar', 'icon' => 'ri-calendar-line', 'url' => BASE_URL . 'pages/calendar/index.php'],
  ],

  'Auditor' => [
    ['label' => 'Dashboard', 'icon' => 'ri-dashboard-line', 'url' => BASE_URL . 'pages/dashboard/index.php'],
    ['label' => 'Liquidation of Expenses', 'icon' => 'ri-money-dollar-box-line', 'url' => BASE_URL . 'pages/liquidation-of-expenses/list.php'],
    ['label' => 'Resolution', 'icon' => 'ri-file-paper-line', 'url' => BASE_URL . 'pages/resolution/list.php'],
    ['label' => 'News Feed', 'icon' => 'ri-news-line', 'url' => BASE_URL . 'pages/news/feed.php'],
    // ['label' => 'Ledger', 'icon' => 'ri-book-line', 'url' => BASE_URL . 'pages/ledger.php'],
    // ['label' => 'Calendar', 'icon' => 'ri-calendar-line', 'url' => BASE_URL . 'pages/calendar/index.php'],
  ],

  'Home Owner' => [
    ['label' => 'Dashboard', 'icon' => 'ri-dashboard-line', 'url' => BASE_URL . 'pages/dashboard/index.php'],
    ['label' => 'Payments', 'icon' => 'ri-wallet-line', 'submenu' => [
        ['label' => 'View Payments', 'icon' => 'ri-eye-line', 'url' => BASE_URL . 'pages/my-fees/fees/list.php'],
        ['label' => 'Payment History', 'icon' => 'ri-history-line', 'url' => BASE_URL . 'pages/my-fees/history/list.php'],
    ]],
    ['label' => 'Resolution', 'icon' => 'ri-file-paper-line', 'url' => BASE_URL . 'pages/resolution/list.php'],
    ['label' => 'News Feed', 'icon' => 'ri-news-line', 'url' => BASE_URL . 'pages/news/feed.php'],
    // ['label' => 'Ledger', 'icon' => 'ri-book-line', 'url' => BASE_URL . 'pages/ledger/list.php'],
    // ['label' => 'Calendar', 'icon' => 'ri-calendar-line', 'url' => BASE_URL . 'pages/calendar/index.php'],
  ],
];
