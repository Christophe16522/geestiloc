/* GestiLoc Docs — English translations */
window.I18N_EN = {
  "nav": {
    "home": "Home",
    "ug_start": "Getting Started",
    "ug_dashboard": "Dashboard",
    "ug_properties": "My Properties",
    "ug_tenants": "My Tenants",
    "ug_contracts": "My Contracts",
    "ug_payments": "Payments",
    "ug_documents": "Documents",
    "ug_maintenance": "Maintenance",
    "fn_overview": "Business Overview",
    "fn_user_stories": "User Stories",
    "fn_modules": "Modules",
    "fn_properties": "Properties",
    "fn_tenants": "Tenants",
    "fn_contracts": "Contracts",
    "fn_payments": "Payments",
    "fn_documents": "Documents",
    "fn_maintenance": "Maintenance",
    "tc_architecture": "Architecture",
    "tc_database": "Database",
    "tc_installation": "Installation",
    "tc_blade": "Blade Components",
    "tc_poc": "POC vs Dynamic",
    "ug": "User Guide",
    "fn": "Functional",
    "tc": "Technical"
  },
  "ui": {
    "breadcrumb_docs": "Docs",
    "lang_toggle": "FR",
    "open_menu": "Open menu"
  },
  "index": {
    "h1": "GestiLoc — Documentation",
    "subtitle": "Technical and functional documentation for the rental management project.",
    "h2": [
      "Project Structure",
      "User Guide",
      "Functional Documentation",
      "Technical Documentation"
    ],
    "h3": [
      "Modules"
    ],
    "th": [
      "Folder",
      "Description"
    ],
    "td": [
      "<code>poc/</code>",
      "Static HTML/CSS/JS prototype (functional mockup)",
      "<code>projet-dynamic/</code>",
      "Dynamic Laravel application",
      "<code>docs/</code>",
      "Technical and functional documentation"
    ],
    "card_label": [
      "User Guide",
      "User Guide",
      "User Guide",
      "User Guide",
      "User Guide",
      "User Guide",
      "User Guide",
      "User Guide",
      "Functional",
      "Functional",
      "Module",
      "Module",
      "Module",
      "Module",
      "Module",
      "Module",
      "Technical",
      "Technical",
      "Technical",
      "Technical",
      "Technical"
    ],
    "card_title": [
      "Getting Started",
      "Dashboard",
      "My Properties",
      "My Tenants",
      "My Contracts",
      "Payments",
      "Documents",
      "Maintenance",
      "Business Overview",
      "User Stories",
      "Properties",
      "Tenants",
      "Contracts",
      "Payments",
      "Documents",
      "Maintenance",
      "Architecture",
      "Database",
      "Installation",
      "Blade Components",
      "POC vs Dynamic"
    ],
    "card_desc": [
      "Create an account, log in, edit your profile.",
      "Understand the metrics and automatic alerts.",
      "Add, edit and manage your property portfolio.",
      "Manage your tenants and track their payment status.",
      "Create leases, manage deadlines and archive.",
      "Record rent payments and mark received payments.",
      "Upload and retrieve your files (leases, reports, insurance…).",
      "Plan and track your maintenance tasks and repairs.",
      "Presentation of GestiLoc, available modules and user roles.",
      "Use cases by module, based on Laravel routes and controllers.",
      "Property portfolio management, types, statuses and auto-generated references.",
      "Tenant management, payment statuses and search.",
      "Rental leases, archiving and expiration alerts.",
      "Monthly rent tracking and payment marking.",
      "File upload and management linked to properties.",
      "Maintenance tracking, priorities, costs and progress.",
      "Tech stack, folder structure and authentication flow.",
      "Schema for the 6 business tables and Eloquent relationships.",
      "Step-by-step Laravel setup: clone, .env, migrate, serve.",
      "List and description of the 26 reusable components.",
      "Differences between the static prototype and the Laravel application."
    ]
  },
  "utilisateur_demarrage": {
    "h1": "Getting Started",
    "subtitle": "Create your account, log in and configure your profile.",
    "h2": [
      "Create an Account",
      "Log In",
      "Log Out",
      "Edit Your Profile",
      "Delete Your Account",
      "Next Step"
    ],
    "p": [
      "If you don't have an account yet, go to the registration page accessible from the login page.",
      "If you forgot your password, use the <strong>Forgot password?</strong> link on the login page.",
      "Click your name in the top-right navigation, then click <strong>Log out</strong>.",
      "To change your name, email address or password:",
      "This option is at the bottom of the <strong>Profile</strong> page, in the <em>Delete account</em> section. A password confirmation is required.",
      "Once logged in, start by adding your properties. See the <a href=\"proprietes.html\">My Properties</a> section for details."
    ],
    "ol": [
      "<li>Click <strong>Register</strong> from the login page.</li><li>Enter your name, email address and a password.</li><li>Click <strong>Register</strong> to confirm.</li><li>You are automatically logged in and redirected to the dashboard.</li>",
      "<li>Open the application in your browser.</li><li>Enter your email address and password.</li><li>Click <strong>Log in</strong>.</li>",
      "<li>Click your name in the top-right corner.</li><li>Select <strong>Profile</strong>.</li><li>Update the desired information.</li><li>Click <strong>Save</strong>.</li>"
    ],
    "callout": [
      "Each account is independent: your properties, tenants and data are only visible to you. Multiple landlords can use the same application without seeing each other's data.",
      "Deleting your account is permanent. All your data (properties, tenants, contracts, payments, documents, maintenance records) will be erased with no possibility of recovery."
    ]
  },
  "utilisateur_tableau_de_bord": {
    "h1": "Dashboard",
    "subtitle": "An overview of your rental portfolio at a glance.",
    "h2": [
      "What You See",
      "Stat Cards",
      "Alerts",
      "Quick Navigation"
    ],
    "p": [
      "The dashboard is the first page you see after logging in. It summarizes the current state of your rental portfolio.",
      "At the top of the dashboard, four key metrics are displayed:",
      "The dashboard automatically flags situations requiring your attention:",
      "From the dashboard, you can navigate directly to any module via the sidebar or the links in the alert cards."
    ],
    "ul": [
      "<li><strong>Expiring contracts</strong> — contracts whose end date is within 30 days.</li><li><strong>Overdue payments</strong> — rent payments with an \"overdue\" status.</li><li><strong>Urgent maintenance</strong> — high-priority maintenance tasks not yet completed.</li>"
    ],
    "callout": [
      "Check the dashboard at the start of each month to quickly identify uncollected rent and plan your follow-up actions."
    ],
    "th": [
      "Metric",
      "What it measures"
    ],
    "td": [
      "<strong>Properties</strong>",
      "Total number of registered properties, including occupied and vacant counts.",
      "<strong>Tenants</strong>",
      "Total number of active tenants.",
      "<strong>Monthly Rent</strong>",
      "Total rent expected for the current month, and the portion already collected.",
      "<strong>Overdue Payments</strong>",
      "Number of overdue rent payments past their due date."
    ]
  },
  "utilisateur_proprietes": {
    "h1": "My Properties",
    "subtitle": "Add, view and manage your property portfolio.",
    "h2": [
      "Add a Property",
      "View Your Property List",
      "Edit a Property",
      "Delete a Property",
      "Property Status",
      "Next Step"
    ],
    "p": [
      "The <strong>Properties</strong> page displays all your properties with their reference, address, type, monthly rent and status (occupied / vacant).",
      "The status is automatically updated based on active contracts associated with the property.",
      "Once your properties are added, add your tenants. See the <a href=\"locataires.html\">My Tenants</a> section."
    ],
    "ol": [
      "<li>Click <strong>Properties</strong> in the sidebar.</li><li>Click the <strong>Add a property</strong> button.</li><li>Fill in the form:</li>",
      "<li>Click <strong>Save</strong>.</li>",
      "<li>In the property list, click the <strong>Edit</strong> button next to the property.</li><li>Update the information.</li><li>Click <strong>Save</strong>.</li>",
      "<li>In the property list, click <strong>Delete</strong>.</li><li>Confirm the deletion in the dialog that appears.</li>"
    ],
    "ul": [
      "<li><strong>Occupied</strong> — a tenant is currently renting.</li><li><strong>Vacant</strong> — the property is available for rent.</li>"
    ],
    "callout": [
      "A unique reference is automatically assigned to each property (e.g., <strong>PROP-001</strong>). You don't need to enter it manually.",
      "Deleting a property also deletes all associated data: linked tenants, contracts, payments, documents and maintenance records. This action cannot be undone."
    ],
    "th": [
      "Field",
      "Description",
      "Required"
    ],
    "td": [
      "<strong>Name</strong>",
      "Property label (e.g., \"Paris 11th apartment\")",
      "Yes",
      "<strong>Type</strong>",
      "Apartment, house, studio, commercial or other",
      "Yes",
      "<strong>Address</strong>",
      "Full address of the property",
      "Yes",
      "<strong>City</strong>",
      "City",
      "Yes",
      "<strong>Postal Code</strong>",
      "Postal code",
      "No",
      "<strong>Area</strong>",
      "Floor area in m²",
      "No",
      "<strong>Monthly Rent</strong>",
      "Rent amount excluding charges",
      "Yes",
      "<strong>Charges</strong>",
      "Monthly utility charges",
      "No (default: 0)",
      "<strong>Security Deposit</strong>",
      "Security deposit amount",
      "No (default: 0)",
      "<strong>Description</strong>",
      "Free notes about the property",
      "No"
    ]
  },
  "utilisateur_locataires": {
    "h1": "My Tenants",
    "subtitle": "Add and manage your tenants, track their payment status.",
    "h2": [
      "Add a Tenant",
      "Understanding Payment Statuses",
      "Search for a Tenant",
      "Edit a Tenant",
      "Delete a Tenant",
      "Next Step"
    ],
    "p": [
      "The search bar at the top of the list filters tenants by first name, last name or email address. Results update in real time.",
      "Once your tenants are added, create the rental contracts. See the <a href=\"contrats.html\">My Contracts</a> section.",
      "A tenant's payment status is updated via the <a href=\"paiements.html\">Payments</a> module when you mark a rent payment as paid."
    ],
    "ol": [
      "<li>Click <strong>Tenants</strong> in the sidebar.</li><li>Click <strong>Add a tenant</strong>.</li><li>Fill in the form:</li>",
      "<li>Click <strong>Save</strong>.</li>",
      "<li>In the list, click <strong>Edit</strong> next to the tenant.</li><li>Update the information.</li><li>Click <strong>Save</strong>.</li>",
      "<li>Click <strong>Delete</strong> in the list.</li><li>Confirm the deletion.</li>"
    ],
    "callout": [
      "Deleting a tenant also deletes all their associated payments and contracts."
    ],
    "th": [
      "Field",
      "Description",
      "Required",
      "Status",
      "Meaning"
    ],
    "td": [
      "<strong>First Name</strong>",
      "Tenant's first name",
      "Yes",
      "<strong>Last Name</strong>",
      "Last name",
      "Yes",
      "<strong>Email</strong>",
      "Contact email address",
      "No",
      "<strong>Phone</strong>",
      "Phone number",
      "No",
      "<strong>Associated Property</strong>",
      "Property occupied by this tenant",
      "No",
      "<strong>Monthly Rent</strong>",
      "Tenant's rent amount",
      "No",
      "<strong>Lease Start Date</strong>",
      "Move-in date",
      "No",
      "<strong>Paid</strong>",
      "The current month's rent has been collected.",
      "<strong>Pending</strong>",
      "The payment has not yet been received for this month.",
      "<strong>Overdue</strong>",
      "The payment was due but has not been collected after the deadline."
    ]
  },
  "utilisateur_contrats": {
    "h1": "My Contracts",
    "subtitle": "Create and manage your rental leases, archive completed contracts.",
    "h2": [
      "Create a Contract",
      "Contract Statuses",
      "Archive a Contract",
      "Expiration Alert",
      "Edit or Delete a Contract"
    ],
    "p": [
      "Before creating a contract, make sure you have already added the property and tenant concerned.",
      "GestiLoc automatically alerts you on the dashboard when a contract expires within <strong>30 days</strong>. Remember to renew or archive these contracts in time.",
      "Archived contracts remain accessible via the <strong>Archived</strong> filter at the top of the contract list."
    ],
    "ol": [
      "<li>Click <strong>Contracts</strong> in the sidebar.</li><li>Click <strong>New contract</strong>.</li><li>Fill in the form:</li>",
      "<li>Click <strong>Save</strong>.</li>",
      "<li>In the contract list, click <strong>Archive</strong> on the relevant contract.</li><li>The contract status changes to <strong>Archived</strong> and it no longer appears in the main list.</li>"
    ],
    "ul": [
      "<li><strong>Edit</strong> — click the <strong>Edit</strong> button in the list to correct the information of an active contract.</li><li><strong>Delete</strong> — permanently deletes the contract. Prefer archiving to keep the history.</li>"
    ],
    "th": [
      "Field",
      "Description",
      "Required",
      "Status",
      "Meaning"
    ],
    "td": [
      "<strong>Tenant</strong>",
      "Tenant concerned by this lease",
      "Yes",
      "<strong>Property</strong>",
      "Property subject to the lease",
      "Yes",
      "<strong>Lease Type</strong>",
      "Unfurnished, furnished or commercial",
      "Yes",
      "<strong>Start Date</strong>",
      "Move-in date",
      "Yes",
      "<strong>End Date</strong>",
      "Lease expiration date (leave empty for open-ended lease)",
      "No",
      "<strong>Monthly Rent</strong>",
      "Rent amount excluding charges",
      "Yes",
      "<strong>Charges</strong>",
      "Monthly charges",
      "No",
      "<strong>Security Deposit</strong>",
      "Security deposit paid",
      "No",
      "<strong>Active</strong>",
      "The lease is ongoing. The tenant occupies the property.",
      "<strong>Expired</strong>",
      "The end date has passed but the contract has not been archived.",
      "<strong>Archived</strong>",
      "The lease is over and filed in the archive."
    ]
  },
  "utilisateur_paiements": {
    "h1": "Payments",
    "subtitle": "Record monthly rent payments and track collections.",
    "h2": [
      "Record a Payment",
      "Mark a Payment as Paid",
      "Payment Statuses",
      "Recommended Monthly Workflow",
      "Filter Payments"
    ],
    "p": [
      "When you receive a rent payment, you can validate it quickly without opening the edit form:",
      "The payment list can be filtered by status, tenant or period (month / year) using the filters at the top of the page.",
      "Use this button each month when you receive bank transfers. It's faster than opening the full edit form."
    ],
    "ol": [
      "<li>Click <strong>Payments</strong> in the sidebar.</li><li>Click <strong>New payment</strong>.</li><li>Fill in the form:</li>",
      "<li>Click <strong>Save</strong>.</li>",
      "<li>In the payment list, find the relevant payment (status: <strong>Pending</strong>).</li><li>Click the <strong>Mark as paid</strong> button.</li><li>The status changes to <strong>Paid</strong> and today's date is recorded automatically.</li>",
      "<li>At the start of the month, create a <strong>Pending</strong> payment for each tenant.</li><li>When you receive each bank transfer, click <strong>Mark as paid</strong>.</li><li>Mid-month, check the dashboard to identify still-pending payments and set them to <strong>Overdue</strong> if needed.</li>"
    ],
    "th": [
      "Field",
      "Description",
      "Required",
      "Status",
      "Meaning"
    ],
    "td": [
      "<strong>Tenant</strong>",
      "Tenant concerned",
      "Yes",
      "<strong>Property</strong>",
      "Property concerned",
      "Yes",
      "<strong>Amount</strong>",
      "Rent amount to collect",
      "Yes",
      "<strong>Month</strong>",
      "Month concerned (1 to 12)",
      "Yes",
      "<strong>Year</strong>",
      "Year concerned",
      "Yes",
      "<strong>Payment Date</strong>",
      "Effective date of payment (if already received)",
      "No",
      "<strong>Status</strong>",
      "Pending, paid or overdue",
      "Yes",
      "<strong>Pending</strong>",
      "Rent expected but not yet collected.",
      "<strong>Paid</strong>",
      "Rent received. Payment date is recorded.",
      "<strong>Overdue</strong>",
      "Rent not collected after the expected due date."
    ]
  },
  "utilisateur_documents": {
    "h1": "Documents",
    "subtitle": "Centralise and retrieve all files related to your properties.",
    "h2": [
      "What Is This Module For?",
      "Upload a Document",
      "Document Categories",
      "Download a Document",
      "Delete a Document",
      "Best Practice: Compliance Reports"
    ],
    "p": [
      "The Documents module lets you store all files related to your landlord activity online: signed lease agreements, mandatory compliance reports (EPC, electrical…), rent receipts, insurance certificates, and any other useful documents.",
      "In the document list, click the name or the <strong>Download</strong> button to retrieve the file on your device.",
      "Click <strong>Delete</strong> in the list. Deletion is permanent. If you uploaded the wrong file, delete it and re-upload the correct one.",
      "It is not possible to edit an already uploaded document. To replace a file, delete the old version and upload the new one.",
      "Enter the <strong>expiry date</strong> for mandatory compliance reports (EPC valid for 10 years, electrical report for 6 years, etc.). This lets you track their validity and plan renewals in advance."
    ],
    "ol": [
      "<li>Click <strong>Documents</strong> in the sidebar.</li><li>Click <strong>Add a document</strong>.</li><li>Fill in the form:</li>",
      "<li>Click <strong>Upload</strong>.</li>"
    ],
    "th": [
      "Field",
      "Description",
      "Required",
      "Category",
      "Examples"
    ],
    "td": [
      "<strong>Name</strong>",
      "Document name (e.g., \"EPC Lyon apartment\")",
      "Yes",
      "<strong>Category</strong>",
      "Contract, report, receipt, insurance or other",
      "Yes",
      "<strong>Associated Property</strong>",
      "Property this document relates to",
      "No",
      "<strong>Upload Date</strong>",
      "Date the document was uploaded",
      "Yes",
      "<strong>Expiry Date</strong>",
      "Validity date (e.g., for an EPC or insurance)",
      "No",
      "<strong>File</strong>",
      "File to upload (PDF, image, etc.)",
      "Yes",
      "<strong>Contract</strong>",
      "Signed lease agreement, lease addendum",
      "<strong>Report</strong>",
      "EPC, electrical report, asbestos, lead, gas",
      "<strong>Receipt</strong>",
      "Monthly rent receipt",
      "<strong>Insurance</strong>",
      "Non-occupying landlord insurance certificate, tenant certificate",
      "<strong>Other</strong>",
      "Photos, utility charge statements, repair invoices"
    ]
  },
  "utilisateur_maintenance": {
    "h1": "Maintenance",
    "subtitle": "Plan and track maintenance tasks and repairs on your properties.",
    "h2": [
      "What Is This Module For?",
      "Create a Maintenance Task",
      "Priority Levels",
      "Track Task Progress",
      "Task Statuses",
      "Record Actual Cost",
      "Urgent Tasks"
    ],
    "p": [
      "The Maintenance module lets you track all work on your properties: urgent repairs reported by a tenant, renovation work, routine maintenance, insurance claims… Each task is tracked with its priority, progress and costs.",
      "As the work progresses, update the progress:",
      "Once the task is complete, enter the <strong>actual cost</strong> in the edit form. This lets you compare the estimated budget with the actual spend, and build a cost history for each property.",
      "Mark a task as <strong>Completed</strong> rather than deleting it. This preserves the full maintenance history for each property, which is useful when selling or in case of a dispute.",
      "High-priority tasks that are not yet completed automatically appear in the <a href=\"tableau-de-bord.html\">dashboard</a> alerts."
    ],
    "ol": [
      "<li>Click <strong>Maintenance</strong> in the sidebar.</li><li>Click <strong>New task</strong>.</li><li>Fill in the form:</li>",
      "<li>Click <strong>Save</strong>.</li>",
      "<li>In the task list, click <strong>Update</strong>.</li><li>Adjust the <strong>progress percentage</strong> (0% to 100%).</li><li>Update the <strong>status</strong> if needed.</li><li>Click <strong>Save</strong>.</li>"
    ],
    "th": [
      "Field",
      "Description",
      "Required",
      "Priority",
      "Recommended Usage",
      "Status",
      "Meaning"
    ],
    "td": [
      "<strong>Property</strong>",
      "Property concerned by the task",
      "Yes",
      "<strong>Title</strong>",
      "Short summary (e.g., \"Kitchen tap leak\")",
      "Yes",
      "<strong>Description</strong>",
      "Task details",
      "No",
      "<strong>Priority</strong>",
      "High, medium or low",
      "Yes",
      "<strong>Estimated Cost</strong>",
      "Planned budget for the task",
      "No",
      "<strong>High</strong>",
      "Emergency: water leak, heating failure in winter, safety issue. Appears in dashboard alerts.",
      "<strong>Medium</strong>",
      "Task to plan soon but not an immediate emergency.",
      "<strong>Low</strong>",
      "Routine maintenance or long-term improvement.",
      "<strong>To Do</strong>",
      "The task is planned but has not started yet.",
      "<strong>In Progress</strong>",
      "Work has started.",
      "<strong>Completed</strong>",
      "The task is closed."
    ]
  },
  "fonctionnel_apercu": {
    "h1": "Business Overview",
    "subtitle": "Business presentation of GestiLoc, its modules and user roles.",
    "h2": [
      "Presentation",
      "Objectives",
      "Available Modules",
      "User Roles"
    ],
    "p": [
      "GestiLoc is a web-based rental management application designed for private landlords. It centralises the management of properties, tenants, rental contracts, rent payments, documents and maintenance tasks.",
      "Authentication is handled by <strong>Laravel Breeze</strong> (email + password).",
      "Multi-role management (owner, manager, tenant) is not implemented in the current version but can be added via a package such as Spatie Laravel Permission."
    ],
    "ul": [
      "<li>Provide an overview of the property portfolio (occupied / vacant)</li><li>Track tenants and their payment status</li><li>Manage rental contracts (creation, archiving, expiration alerts)</li><li>Record and track monthly payments</li><li>Centralise documents linked to properties (contracts, reports, receipts, insurance)</li><li>Plan and track maintenance work</li>"
    ],
    "th": [
      "Module",
      "Description",
      "Role",
      "Description"
    ],
    "td": [
      "<strong>Dashboard</strong>",
      "Global statistics, alerts, summary view",
      "<strong>Properties</strong>",
      "Property CRUD",
      "<strong>Tenants</strong>",
      "Tenant CRUD, payment status",
      "<strong>Contracts</strong>",
      "Lease management, archiving, expiration alerts",
      "<strong>Payments</strong>",
      "Monthly rent tracking, mark as paid",
      "<strong>Documents</strong>",
      "Upload and management of property-linked files",
      "<strong>Maintenance</strong>",
      "Task tracking with progress and costs",
      "<strong>Reports</strong>",
      "Aggregated financial and operational view",
      "<strong>Landlord (authenticated user)</strong>",
      "Full access to all features. All data is scoped by <code>user_id</code> — each landlord only sees their own properties, tenants, contracts, etc."
    ]
  },
  "fonctionnel_user_stories": {
    "h1": "User Stories",
    "subtitle": "Use cases by module, based on Laravel routes and controllers.",
    "h2": [
      "Authentication",
      "Dashboard",
      "Properties",
      "Tenants",
      "Contracts",
      "Payments",
      "Documents",
      "Maintenance",
      "Reports"
    ],
    "callout": [
      "All stories below correspond to real actions implemented in <code>projet-dynamic/routes/web.php</code> and the associated controllers."
    ],
    "ul": [
      "<li>As a landlord, I can register with an email and password.</li><li>As a landlord, I can log in with my Google account via <code>GET /auth/google</code>.</li><li>As a landlord, I can log in and log out.</li><li>As a landlord, I can edit my profile (name, email, password).</li><li>As a landlord, I can delete my account.</li><li>As a landlord, I can switch the interface language (FR/EN) via <code>GET /lang/{locale}</code>.</li>",
      "<li>As a landlord, I can see a summary of my portfolio: number of properties, number of tenants, this month's rent, current alerts.</li>",
      "<li>As a landlord, I can add a property (type, address, rent, charges, security deposit).</li><li>As a landlord, I can view my property list with their status (occupied / vacant).</li><li>As a landlord, I can edit a property's information.</li><li>As a landlord, I can delete a property (along with all associated data in cascade).</li><li>As a landlord, a unique reference is auto-generated for each property (e.g., <code>PROP-001</code>).</li>",
      "<li>As a landlord, I can add a tenant and associate them with a property.</li><li>As a landlord, I can view my tenant list with their payment status.</li><li>As a landlord, I can search for a tenant by name or email.</li><li>As a landlord, I can edit a tenant's information.</li><li>As a landlord, I can delete a tenant.</li>",
      "<li>As a landlord, I can create a rental contract (type: unfurnished/furnished/commercial, dates, rent).</li><li>As a landlord, I can view my contract list and their status (active, expired, archived).</li><li>As a landlord, I can archive an active contract via <code>PATCH /contracts/{id}/archive</code>.</li><li>As a landlord, I am alerted when a contract expires within 30 days.</li><li>As a landlord, I can edit or delete a contract.</li>",
      "<li>As a landlord, I can record a monthly payment for a tenant.</li><li>As a landlord, I can view payment history by tenant or by property.</li><li>As a landlord, I can mark a payment as \"paid\" in one click via <code>PATCH /payments/{id}/mark-paid</code>.</li><li>As a landlord, I can view overdue payments.</li>",
      "<li>As a landlord, I can upload a document and link it to a property (contract, report, receipt, insurance).</li><li>As a landlord, I can view my document list with their category and expiry date.</li><li>As a landlord, I can download or delete a document.</li>",
      "<li>As a landlord, I can create a maintenance task for a property (title, description, priority, estimated cost).</li><li>As a landlord, I can view the task list and their progress.</li><li>As a landlord, I can update task progress via <code>PATCH /maintenances/{id}/progress</code>.</li><li>As a landlord, I can view urgent tasks (high priority, not yet completed).</li>",
      "<li>As a landlord, I can access a reports page to visualise aggregated financial and operational data.</li>"
    ]
  },
  "technique_architecture": {
    "h1": "Technical Architecture",
    "subtitle": "Technology stack, folder structure, services and authentication flow.",
    "h2": [
      "Stack",
      "Folder Structure",
      "Authentication Flow",
      "Controllers",
      "Services",
      "Middleware",
      "Applied Principles"
    ],
    "ol": [
      "<li>The user accesses `/` → automatic redirect to `/dashboard`</li><li>If not authenticated → redirect to `/login` (middleware `auth`)</li><li>Registration via `/register` (Laravel Breeze) or Google login via `/auth/google`</li><li>After login → access to all routes in the `auth` group</li><li>All data is filtered by `user_id` (multi-user isolation)</li><li>Language switch via `GET /lang/{locale}` → stored in session</li>"
    ],
    "ul": [
      "<li><strong>SOLID</strong> — one controller per resource, single responsibility</li><li><strong>DRY</strong> — reusable Blade components for all recurring UI elements</li><li><strong>Scoped data</strong> — every query filters on <code>user_id</code> to isolate data per landlord</li>"
    ],
    "th": [
      "Layer",
      "Technology",
      "Controller",
      "Responsibility"
    ],
    "td": [
      "Backend framework",
      "Laravel 10",
      "Language",
      "PHP 8.1+",
      "Templating",
      "Blade (reusable components)",
      "CSS",
      "Tailwind CSS (via Vite)",
      "JS interactivity",
      "Alpine.js",
      "Build tool",
      "Vite",
      "Authentication",
      "Laravel Breeze",
      "Database",
      "SQLite (dev) / MySQL (prod)",
      "<code>DashboardController</code>",
      "Global dashboard statistics",
      "<code>PropertyController</code>",
      "Property CRUD",
      "<code>TenantController</code>",
      "Tenant CRUD",
      "<code>ContractController</code>",
      "Contract CRUD + archiving",
      "<code>PaymentController</code>",
      "Payment CRUD + mark-paid",
      "<code>DocumentController</code>",
      "Document upload / deletion",
      "<code>MaintenanceController</code>",
      "Maintenance CRUD + progress",
      "<code>ReportController</code>",
      "Aggregated reports page",
      "<code>ProfileController</code>",
      "User profile management"
    ],
    "p": [
      "Each module has a dedicated service in `app/Services/` that encapsulates business logic, separating responsibilities from controllers."
    ]
  },
  "technique_installation": {
    "h1": "Installation",
    "subtitle": "Step-by-step Laravel application setup.",
    "h2": [
      "Prerequisites",
      "1. Clone the Repository",
      "2. Install PHP Dependencies",
      "3. Configure the Environment",
      "4. Create the SQLite Database",
      "5. Run Migrations",
      "6. Install Front-end Dependencies",
      "7. Compile Assets",
      "8. Start the Server",
      "Quick Summary"
    ],
    "p": [
      "Edit <code>.env</code> according to your environment:",
      "The application is accessible at <code>http://localhost:8000</code>.",
      "Optional — seed with test data:"
    ],
    "ul": [
      "<li>PHP 8.1+</li><li>Composer</li><li>Node.js 18+ and npm</li><li>SQLite (included in PHP) or MySQL</li>"
    ],
    "callout": [
      "This step is only required for SQLite. For MySQL, create the database using your usual interface.",
      "For development, keep <code>npm run dev</code> running in a separate terminal to benefit from Vite's hot module replacement (HMR)."
    ]
  },
  "technique_composants_blade": {
    "h1": "Blade Components",
    "subtitle": "All components are in <code>projet-dynamic/resources/views/components/</code>. Use them with the <code>&lt;x-component-name /&gt;</code> syntax.",
    "h2": [
      "Generic Components (Breeze)",
      "GestiLoc Business Components",
      "Usage"
    ],
    "p": [
      "These components come from Laravel Breeze and are used in forms and authentication.",
      "These components were created specifically for the application, following the DRY principle.",
      "Business components accept <code>props</code> to be configurable without duplication. Examples:",
      "To add a component: create the file in <code>resources/views/components/</code>. Laravel detects it automatically via naming convention — no manual registration required."
    ],
    "th": [
      "Component",
      "File",
      "Description"
    ],
    "td": [
      "<code>&lt;x-primary-button&gt;</code>",
      "<code>primary-button.blade.php</code>",
      "Primary button (main action)",
      "<code>&lt;x-secondary-button&gt;</code>",
      "<code>secondary-button.blade.php</code>",
      "Secondary button",
      "<code>&lt;x-danger-button&gt;</code>",
      "<code>danger-button.blade.php</code>",
      "Destructive button (delete)",
      "<code>&lt;x-text-input&gt;</code>",
      "<code>text-input.blade.php</code>",
      "Standard text input",
      "<code>&lt;x-input-label&gt;</code>",
      "<code>input-label.blade.php</code>",
      "Form label",
      "<code>&lt;x-input-error&gt;</code>",
      "<code>input-error.blade.php</code>",
      "Validation error display",
      "<code>&lt;x-dropdown&gt;</code>",
      "<code>dropdown.blade.php</code>",
      "Alpine.js dropdown menu",
      "<code>&lt;x-dropdown-link&gt;</code>",
      "<code>dropdown-link.blade.php</code>",
      "Link inside a dropdown",
      "<code>&lt;x-modal&gt;</code>",
      "<code>modal.blade.php</code>",
      "Alpine.js modal",
      "<code>&lt;x-nav-link&gt;</code>",
      "<code>nav-link.blade.php</code>",
      "Navigation link (active / inactive)",
      "<code>&lt;x-responsive-nav-link&gt;</code>",
      "<code>responsive-nav-link.blade.php</code>",
      "Mobile nav link",
      "<code>&lt;x-auth-session-status&gt;</code>",
      "<code>auth-session-status.blade.php</code>",
      "Session status message",
      "<code>&lt;x-application-logo&gt;</code>",
      "<code>application-logo.blade.php</code>",
      "Application logo",
      "<code>&lt;x-navbar&gt;</code>",
      "<code>navbar.blade.php</code>",
      "Main navigation bar",
      "<code>&lt;x-sidebar&gt;</code>",
      "<code>sidebar.blade.php</code>",
      "Sidebar navigation menu",
      "<code>&lt;x-page-header&gt;</code>",
      "<code>page-header.blade.php</code>",
      "Page header (title + action button)",
      "<code>&lt;x-stat-card&gt;</code>",
      "<code>stat-card.blade.php</code>",
      "Stat card for the dashboard",
      "<code>&lt;x-status-badge&gt;</code>",
      "<code>status-badge.blade.php</code>",
      "Coloured status badge",
      "<code>&lt;x-action-buttons&gt;</code>",
      "<code>action-buttons.blade.php</code>",
      "Action buttons (edit, delete)",
      "<code>&lt;x-data-table&gt;</code>",
      "<code>data-table.blade.php</code>",
      "Reusable data table",
      "<code>&lt;x-empty-state&gt;</code>",
      "<code>empty-state.blade.php</code>",
      "Empty list message",
      "<code>&lt;x-progress-bar&gt;</code>",
      "<code>progress-bar.blade.php</code>",
      "Progress bar (maintenance)",
      "<code>&lt;x-form-section&gt;</code>",
      "<code>form-section.blade.php</code>",
      "Form section with title",
      "<code>&lt;x-toast&gt;</code>",
      "<code>toast.blade.php</code>",
      "Flash notification (success, error)",
      "<code>&lt;x-property-card&gt;</code>",
      "<code>property-card.blade.php</code>",
      "Property display card",
      "<code>&lt;x-tenant-card&gt;</code>",
      "<code>tenant-card.blade.php</code>",
      "Tenant display card"
    ]
  },
  "technique_poc_vs_dynamic": {
    "h1": "POC vs Dynamic Project",
    "subtitle": "Comparison between the static prototype (<code>poc/</code>) and the Laravel application (<code>projet-dynamic/</code>).",
    "h2": [
      "Overview",
      "Purpose of the POC",
      "What the Dynamic Project Adds",
      "Module Mapping"
    ],
    "p": [
      "The <code>poc/</code> folder is a high-fidelity mockup designed to:"
    ],
    "ul": [
      "<li>Validate the interface and navigation before development</li><li>Present the project without a back-end infrastructure</li><li>Serve as a visual reference during development</li>"
    ],
    "ol": [
      "<li><strong>Persistence</strong> — data survives page reloads</li><li><strong>Authentication</strong> — each landlord has their own scoped data</li><li><strong>Server validation</strong> — forms are validated server-side by Laravel</li><li><strong>Business actions</strong> — mark-paid, contract archiving, maintenance progress</li><li><strong>Reusable components</strong> — zero HTML duplication thanks to Blade components</li><li><strong>Reports</strong> — real data aggregation</li><li><strong>File uploads</strong> — document storage on the server</li>"
    ],
    "th": [
      "Criterion",
      "<code>poc/</code>",
      "<code>projet-dynamic/</code>",
      "Module",
      "POC",
      "Dynamic project"
    ],
    "td": [
      "Type",
      "Static prototype",
      "Full Laravel application",
      "Data",
      "Hardcoded / fictitious",
      "Persisted in database",
      "Authentication",
      "None",
      "Laravel Breeze (email + password)",
      "Backend",
      "None",
      "Laravel 10 / PHP 8.1",
      "Templating",
      "Raw HTML",
      "Blade + reusable components",
      "CSS",
      "Tailwind CDN",
      "Tailwind compiled via Vite",
      "JS",
      "Alpine.js CDN",
      "Alpine.js via npm",
      "Multi-user",
      "No",
      "Yes (scoped by <code>user_id</code>)",
      "Real CRUD",
      "No",
      "Yes (all modules)",
      "Dashboard",
      "Static page with fictitious data",
      "<code>DashboardController</code> + real data",
      "Properties",
      "Fixed HTML list",
      "Full CRUD + auto-generated reference",
      "Tenants",
      "Fixed HTML list",
      "CRUD + search + payment status",
      "Contracts",
      "Displayed statically",
      "CRUD + archiving + 30-day expiration alerts",
      "Payments",
      "Static table",
      "CRUD + mark-paid + period filters",
      "Documents",
      "Static list",
      "Real upload + download + categories",
      "Maintenance",
      "Static list",
      "CRUD + progress bar + cost tracking"
    ]
  },
  "technique_base_de_donnees": {
    "h1": "Database",
    "subtitle": "Schema for business tables, users table and Eloquent relationships.",
    "h2": [
      "Overview",
      "users table",
      "properties table",
      "tenants table",
      "contracts table",
      "payments table",
      "documents table",
      "maintenances table",
      "Eloquent Relationships — Summary"
    ],
    "th": [
      "Column",
      "Type",
      "Constraints",
      "Model",
      "hasMany",
      "belongsTo"
    ]
  }
};
