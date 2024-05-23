# crud-add-pdf-feature
# crud-project
Dear Interns,

Great job on completing the CRUD project Now, I'd like to challenge you to add PDF Export Feature with DomPdf

Remember to ensure that all functionalities are working seamlessly. If you have any questions or need guidance, don't hesitate to reach out.

Good luck, and I look forward to seeing your progress!


# CRUD Project with PDF Export Feature Integration

Dear Interns,

Great job on completing the CRUD project! Now, I'd like to challenge you to add a PDF Export Feature using DomPdf.

## PDF Export Feature Integration

This guide will help you integrate a PDF export feature into your existing CRUD project using the Dompdf library. This feature allows users to export all team members or individual team member details as a PDF.

### Prerequisites

Ensure you have Composer installed. Follow the instructions at [getcomposer.org](https://getcomposer.org) if you haven't installed it yet. Windows users can download the software and install it 

### Installation Steps

#### Step 1: Initialize Composer in Your Project

Open a terminal or command prompt.

Navigate to your project directory.

Run the following command to initialize Composer:


#### Step 2: Install Dompdf

Run the following command in your project directory to install Dompdf:
```bash
Composer require dompdf/dompdf
```
#### Step 3: Integrate PDF Export Feature

##### 3.1. Export All Team Members as PDF

**Add Export Button to Dashboard**

In your dashboard PHP file, add the following button to export all team members as a PDF. Format the team members on a table like this [Sample PDF Format](./mathew%20opoku%20voters_list.pdf) . The pdf should display the image, Firstname, Lastname, position, and department of all members of the team nicely arranged in a pdf format the sample pdf I showed you earlier.

```html
<button onclick="window.location.href='export_all_pdf.php'">Export Team Members as PDF</button>
```

**Create export_all_pdf.php**
```php
<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;

// Database connection and data fetching

// Generate PDF using Dompdf

// Stream PDF to browser
?>
```
##### 3.2. Export Single Team Member as PDF
This display the image, Firstname, Lastname, position, department and the short description of a particular user nicely formatted.

**Add Export Button to Read Page**

On the read page (view details of a single team member), add an "Export to PDF" button:
```html
<button onclick="window.location.href='export_single_pdf.php?id=<?php echo $team_member_id; ?>'">Export to PDF</button>
```
**Create export_single_pdf.php**

```php
<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;

// Database connection and data fetching

// Generate PDF using Dompdf

// Stream PDF to the browser
?>
```
Good luck with your implementation!
