🏡 HOA CONNECT: HOMEOWNERS ASSOCIATION MANAGEMENT SYSTEM

Project Description (Revised Version)

🧭 Overview

The HOA Connect Management System is a web-based platform designed to centralize and streamline all operations within a Homeowners Association (HOA). It allows administrators, officers, and homeowners to manage community activities, financial transactions, projects, and records efficiently.

This system replaces traditional manual workflows by introducing an online interface for announcements, document requests, project monitoring, and payment tracking — ensuring transparency, accountability, and accessibility for all HOA members.

🎯 Objectives

To create a centralized database system for all HOA transactions and records.

To simplify communication through announcements and newsfeeds (no direct messaging).

To digitize payment tracking, allowing homeowners to upload proof of payment for verification.

To provide role-based dashboards for Admin, President, Treasurer, Secretary, Auditor, and Homeowners.

To maintain a recorded and transparent ledger of payments, projects, and budgets.

👥 System Users and Roles
User Role	Description
Administrator	Oversees all modules, manages users, fees, and approvals.
President	Reviews and approves projects and proposals as well as manages admin accounts.
Treasurer	Verifies payments, manages ledgers, and generates financial reports.
Secretary	Manages documents and announcements.
Auditor	Reviews budgets, liquidation, and ledger reports.
Homeowner	Views fees, uploads proof of payment, books facilities, and sees announcements.
⚙️ Key Features
🏠 1. Dashboard Overview

Displays key metrics: total homeowners, ongoing projects, pending payments, and verified payments.

Role-specific content per user (Admin, President, Treasurer, etc.).

📋 2. Financial Management
Fee Management

Admin can define different fee types (e.g., Monthly Dues, Maintenance Fees, Facility Fees).

Assign fees to homeowners manually or automatically by phase/zone.

Payment Processing (Updated)

No online payment gateway.

Homeowners manually transfer or deposit payments to the official HOA account.

After transfer, the homeowner uploads proof of payment (receipt image).

System records:

Homeowner name

Fee type / month / period

Amount

Upload timestamp

Proof of payment (image filename)

Payment status: Pending, Verified, Rejected

Verified by (Treasurer/Admin)

Remarks (optional)

Payment Verification Workflow

Treasurer/Admin checks uploaded receipts in the Payment Verification Table.

They can:

✅ Verify payment — automatically updates homeowner ledger.

❌ Reject payment — with remarks for invalid receipts.

Verified payments are stored in history and can be exported to PDF or Excel.

Ledger Management

Automatically updates upon verification.

Displays total paid, unpaid, and pending fees.

Separate ledger per homeowner and consolidated ledger for Admin.

Remittance Module

Tracks collections and disbursements.

Displays verification and total remitted funds.

🏗️ 3. Project Management

Presidents and Admins can post HOA projects (e.g., road repairs, drainage improvement).

Project details include:

Title, description, start/end date, budget, and status.

Audit and Treasurer can track project fund allocations.

Homeowners can view updates in the “HOA Projects” section.

📅 4. Calendar and Scheduling

Displays upcoming meetings, project schedules, and community events.

Events can be added by Admin, President, or Secretary.

📰 5. Announcements and Newsfeed

Used for updates, meeting reminders, and HOA-related notices.

Replaces the old messaging system.

Admin and Secretary can post news and attach images or documents.

All users can read posts in their respective dashboards.

📑 6. Document and Records Management

Secretary uploads HOA documents (e.g., policies, meeting minutes, forms).

Documents are organized by type and date.

Download permissions are controlled by role.

🧾 7. Reports and Analytics

Automatically generated reports for:

Verified Payments

Pending Payments

Homeowner Dues Summary

Project Budget Reports

Audit Reports

Exportable to PDF or Excel.

👤 8. User Account Management

Admin creates and manages user accounts.

Each user receives login details via email.

Profiles are editable (name, contact, photo).

Role-based authentication and access control.

🏛️ 9. Facility and Resource Booking

Homeowners can request to book facilities (e.g., court, clubhouse, stalls).

Admin approves or rejects bookings.

Each facility has a fixed rate per month, not per hour.

Payment is uploaded the same way as monthly dues — with proof for verification.

📂 Database Structure (Simplified)
users

id

name

email

password

role (admin, president, treasurer, secretary, auditor, homeowner)

contact_no

address

created_at

updated_at

payments

id

homeowner_id (FK to users)

fee_assignment_id (FK)

amount

proof_of_payment (VARCHAR)

status (Pending, Verified, Rejected)

verified_by (FK to users)

remarks (TEXT)

created_at

updated_at

fee_types

id

name

description

created_at

updated_at

fee_assignments

id

fee_type_id (FK)

homeowner_id (FK)

amount

due_date

created_at

updated_at

projects

id

title

description

budget

start_date

end_date

status (Ongoing, Completed, Cancelled)

created_by (FK)

created_at

updated_at

documents

id

title

file_name

uploaded_by (FK)

created_at

updated_at

announcements

id

title

content

image

posted_by (FK)

created_at

bookings

id

homeowner_id (FK)

facility_type

date_requested

amount

proof_of_payment

status (Pending, Approved, Rejected)

verified_by (FK)

remarks

created_at

updated_at

🗂️ Folder Structure (Updated)
Template 1/
├── admin/
│   ├── admin-dashboard.html
│   ├── admin-users.html
│   ├── admin-calendar.html
│   ├── admin-newsfeed.html
│   ├── admin-ledger.html
│   ├── admin-remittance.html
│   ├── admin-hoaprojects.html
│   ├── admin-court.html
│   ├── admin-stall.html
│   ├── admin-tricycle.html
│   ├── admin-profile.html
│   ├── fee-types.html
│   ├── fee-assignation.html
│   ├── payment-verification.html
│   └── payment-history.html
│
├── president/
│   ├── president-dashboard.html
│   ├── president-calendar.html
│   ├── president-court.html
│   ├── president-hoaprojects.html
│   ├── president-ledger.html
│   ├── president-newsfeed.html
│   ├── president-profile.html
│   ├── president-projectproposal.html
│   ├── president-remittance.html
│   ├── president-stall.html
│   ├── president-tricycle.html
│   └── president-users.html
│
├── treasurer/
│   ├── treasurer-dashboard.html
│   ├── treasurer-calendar.html
│   ├── treasurer-ledger.html
│   ├── treasurer-newsfeed.html
│   ├── treasurer-profile.html
│   ├── treasurer-remittance.html
│   └── payment-verification.html
│
├── secretary/
│   ├── secretary-dashboard.html
│   ├── secretary-calendar.html
│   ├── secretary-newsfeed.html
│   ├── secretary-profile.html
│   └── secretary-documents.html
│
├── audit/
│   ├── aud-dashboard.html
│   ├── aud-calendar.html
│   ├── aud-ledger.html
│   ├── aud-liquidation.html
│   ├── aud-newsfeed.html
│   ├── aud-profile.html
│   └── aud-projectproposal.html
│
├── home-owner/
│   ├── homeowner-dashboard.html
│   ├── homeowner-calendar.html
│   ├── homeowner-ledger.html
│   ├── homeowner-payment.html
│   ├── homeowner-history.html
│   ├── homeowner-hoa-projects.html
│   ├── homeowner-newsfeed.html
│   └── homeowner-profile.html

📧 Email Notifications

Login Credentials Email

New Fee Assignment Notification

Unpaid Dues Reminder

Payment Verified Notification

Booking Confirmation

Project Approval Notification

!! Timeline for project completion is on November 21 tentative !!

!! The communication (messaging feature) and SMS notification is already removed from our capstone project !!