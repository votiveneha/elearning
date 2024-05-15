<style type="text/css">
  .main-sidebar {
    height: 100vh;
    overflow-y: inherit;
    z-index: 1038;
}
</style>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/admin/dashboard') }}" class="brand-link">
      <img src="{{ url('/public') }}/assets/img/admin_logo.png" alt="Admin Logo" class="brand-image  elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Mathify</span>
    </a>

    <div class="sidebar" style="float:left;">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('/public') }}/assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"><li class="nav-item">
            <a href="{{ url('/admin/dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/admin/studentlist') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Student Management
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/admin/courselist') }}" class="nav-link">
              <i class="nav-icon fas fa-book-open"></i>
              <p>
                Course Management
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/admin/topiclist') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>

              <p>
                Topics Management
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="{{ url('/admin/subtopiclist') }}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Chapter Management
              </p>
            </a>
          </li>  -->
          <li class="nav-item">
            <a href="{{ url('/admin/show_questions') }}?question_type=quiz" class="nav-link">
              <i class="nav-icon fas fa-question"></i>
              <p>
                Quiz Management
              </p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="{{ url('/admin/exam_builder_management') }}?question_type=exam_builder" class="nav-link">
              <i class="nav-icon fas fa-book-open"></i>
              <p>
                Exam Builder Management
              </p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="{{ url('/admin/payment_details') }}?question_type=exam_builder" class="nav-link">
              <i class="nav-icon fas fa-book-open"></i>
              <p>
                Payment Management
              </p>
            </a>
          </li> 
            <!-- <li class="nav-item">
            <a href="{{ url('/admin/theorylist') }}" class="nav-link">
              <i class="nav-icon fas fa-book-open"></i>
              <p>
                Theory Management
              </p>
            </a>
          </li>  -->



        </ul>
      </nav>
    </div>
  </aside>

