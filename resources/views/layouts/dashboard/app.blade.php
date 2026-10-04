<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم · إدارة الصلاحيات</title>
    <!-- Bootstrap RTL (for quick layout, but we'll add custom styles) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <!-- Font Awesome 6 (free) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Font: Cairo for Arabic -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS for the dashboard -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/style.css') }}">
  
</head>
<body>

    <div class="app-wrapper">
        <!-- ========== SIDEBAR (from section-menu-left) ========== -->
        

          @include('includes.dashboard.sidebar')


        <!-- ========== MAIN CONTENT ========== -->
        <div class="main-content">
            <!-- ========== HEADER DASHBOARD ========== -->
           

                      @include('includes.dashboard.header')

            <!-- ========== PAGE CONTENT (INTERACTIVE PERMISSIONS) ========== -->
            @yield('content')
        </div>
    </div>

    <!-- Toast container -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Custom delete modal -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-box">
            <div class="icon-circle"><i class="fas fa-trash-alt"></i></div>
            <h3>تأكيد الحذف</h3>
            <p>هل أنت متأكد من حذف هذه الصلاحية؟ لا يمكن التراجع عن هذا الإجراء.</p>
            <div class="modal-actions">
                <button class="btn btn-outline" id="modalCancel">إلغاء</button>
                <button class="btn btn-danger" id="modalConfirm">نعم، احذف</button>
            </div>
        </div>
    </div>

  @include('includes.dashboard.scripts')
</body>
</html>