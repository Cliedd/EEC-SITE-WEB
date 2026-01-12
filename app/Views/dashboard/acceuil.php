<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Centre Medicale Prostestant de Bafoussam</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="<?=base_url('../assets/css/styles.min.css');?>" />

</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <!--  App Topstrip -->
    <div class="app-topstrip bg-dark py-3 px-4 w-100 d-lg-flex align-items-center justify-content-between">
      <div class="d-none d-sm-flex align-items-center justify-content-center gap-9 mb-3 mb-lg-0">
        <a class="d-flex justify-content-center" href="https://www.wrappixel.com/" target="_blank">
          <img src="../assets/images/logos/LOGO_SITE.png" alt="" width="50px">
        </a>

        <div class="d-none d-xl-flex align-items-center gap-3 border-start border-white border-opacity-25 ps-9">
          <a href="/"
            class="link-hover d-flex align-items-center gap-2 border-0 text-white lh-sm fs-4">
            <iconify-icon class="fs-6" icon="solar:question-circle-linear"></iconify-icon>
            aide
          </a>
          <a href="/"
            class="link-hover d-flex align-items-center gap-2 border-0 text-white lh-sm fs-4">
            <iconify-icon class="fs-6" icon="solar:case-round-linear"></iconify-icon>
            Nous choisir
          </a>
        </div>
      </div>

      <div class="d-lg-flex align-items-center gap-3">
        <div class="d-sm-flex align-items-center justify-content-center gap-8">
          <div class="d-flex align-items-center justify-content-center gap-8 mb-3 mb-sm-0">
            <div class="dropdown d-flex">
              <a class="btn live-preview-drop fs-4 lh-sm btn-outline-primary rounded border-white border border-opacity-40 text-white d-flex align-items-center gap-2 px-3 py-2"
                href="javascript:void(0)" id="drop3" data-bs-toggle="dropdown" aria-expanded="false">
                Nos services
                <iconify-icon class="fs-6" icon="solar:alt-arrow-down-linear"></iconify-icon>
              </a>
              <div class="dropdown-menu p-3 dropdown-menu-end dropdown-menu-animate-up overflow-hidden rounded"
                aria-labelledby="drop3">
                <div class="message-body">
                  <a target="_blank"
                    href="/"
                    class="dropdown-item rounded fw-normal d-flex align-items-center gap-6">
                    Pédiatrie/ Néonatologie
                  </a>
                  <a target="_blank"
                    href="/"
                    class="dropdown-item rounded fw-normal d-flex align-items-center gap-6">
                    Obdtétrique/ Gynécologie
                  </a>
                  <a target="_blank"
                    href="/"
                    class="dropdown-item rounded fw-normal d-flex align-items-center gap-6">
                    Chirugie générale
                  </a>
                  <a target="_blank"
                    href="/"
                    class="dropdown-item rounded fw-normal d-flex align-items-center gap-6">
                    Medecine interne
                  </a>
                  <a target="_blank"
                    href="/"
                    class="dropdown-item rounded fw-normal d-flex align-items-center gap-6">
                    Neurologie
                  </a>
                  <a target="_blank" href="/" class="dropdown-item rounded fw-normal d-flex align-items-center gap-6">
                    Réanimation
                  </a>
                  <a target="_blank" href="/" class="dropdown-item rounded fw-normal d-flex align-items-center gap-6">
                    Kinésithérapie
                  </a>
                  <a target="_blank" href="/" class="dropdown-item rounded fw-normal d-flex align-items-center gap-6">
                    Nutrition
                  </a>
                  <a target="_blank" href="/" class="dropdown-item rounded fw-normal d-flex align-items-center gap-6">
                    Echographie
                  </a>
                  <a target="_blank" href="/" class="dropdown-item rounded fw-normal d-flex align-items-center gap-6">
                    Laboratoire
                  </a>
                  <a target="_blank" href="/" class="dropdown-item rounded fw-normal d-flex align-items-center gap-6">
                    UPEC
                  </a>
                  <a target="_blank" href="/" class="dropdown-item rounded fw-normal d-flex align-items-center gap-6">
                    Vaccination
                  </a>
                </div>
              </div>
            </div>
            <a target="_blank"
              class="get-pro-btn rounded btn btn-primary d-flex align-items-center gap-2 fs-4 border-0 px-3 py-2"
              href="/">
              <iconify-icon class="fs-5" icon="solar:crown-linear"></iconify-icon>
              Fair un don
            </a>
          </div>
        </div>
      </div>

    </div>
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            <img src="../assets/images/logos/logo.svg" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link"  href="<?=site_url('admin');?>" aria-expanded="false">
                <iconify-icon icon="solar:atom-line-duotone"></iconify-icon>
                <span class="hide-menu">Acceuil</span>
              </a>
            </li>
            <!-- ---------------------------------- -->
            <!-- Dashboard -->
            <!-- ---------------------------------- -->
            
            <li class="sidebar-item">
              <a class="sidebar-link justify-content-between has-arrow" href="javascript:void(0)" aria-expanded="false">
                <div class="d-flex align-items-center gap-3">
                  <span class="d-flex">
                    <iconify-icon icon="solar:home-angle-line-duotone"></iconify-icon>
                  </span>
                  <span class="hide-menu">Front Pages</span>
                </div>
                
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link justify-content-between" target="_blank" href="<?=site_url('acceuil');?>">
                    <div class="d-flex align-items-center gap-3">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">Page d'acceuil</span>
                    </div>
                    <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1"></span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link justify-content-between" target="_blank"
                    href="<?=site_url('a_propos');?>">
                    <div class="d-flex align-items-center gap-3">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">A propos</span>
                    </div>
                    <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1"></span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link justify-content-between" target="_blank"
                    href="<?=site_url('service_medicaux');?>">
                    <div class="d-flex align-items-center gap-3">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">Services Médicaux</span>
                    </div>
                    <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1"></span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link justify-content-between" target="_blank"
                    href="<?=site_url('espace_peteint');?>">
                    <div class="d-flex align-items-center gap-3">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">Espace patient</span>
                    </div>
                    <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1"></span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link justify-content-between" target="_blank"
                    href="<?=site_url('Contact');?>">
                    <div class="d-flex align-items-center gap-3">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">Contact</span>
                    </div>
                    <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1"></span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link justify-content-between" target="_blank"
                    href="<?=site_url('actualiter');?>">
                    <div class="d-flex align-items-center gap-3">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">Actualités</span>
                    </div>
                    <span class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1"></span>
                  </a>
                </li>
              </ul>




































 <!-- Creer compte et s'inscrire ----------------------------------------------->
            <li>
              <span class="sidebar-divider lg"></span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?=site_url('creer_un_compte');?>" aria-expanded="false">
                <iconify-icon icon="solar:login-3-line-duotone"></iconify-icon>
                <span class="hide-menu">Creer un compte</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?=site_url('sinscrire');?>" aria-expanded="false">
                <iconify-icon icon="solar:user-plus-rounded-line-duotone"></iconify-icon>
                <span class="hide-menu">S'inscrire</span>
              </a>
            </li>













        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link " href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown" aria-expanded="false">
                <iconify-icon icon="solar:bell-linear" class="fs-6"></iconify-icon>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
              <div class="dropdown-menu dropdown-menu-animate-up" aria-labelledby="drop1">
                <div class="message-body">
                  <a href="javascript:void(0)" class="dropdown-item">
                    Item 1
                  </a>
                  <a href="javascript:void(0)" class="dropdown-item">
                    Item 2
                  </a>
                </div>
              </div>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <a href="https://www.wrappixel.com/templates/materialm-admin-dashboard-template/?ref=376#demos" target="_blank"
                class="btn btn-primary">Docteur</a>
              <li class="nav-item dropdown">
                <a class="nav-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <!--  Row 1-------------------------------------------------------------------- -->
          <div class="row">
            <div class="col-lg-8 d-flex align-items-strech">
              <div class="card w-100">
                <div class="card-body">
                  <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                      <h5 class="card-title fw-semibold">Lise des rendez-vous prise</h5>
                    </div>
                    <div>
                      <select class="form-select">
                        <option value="1">March 2025</option>
                        <option value="2">April 2025</option>
                        <option value="3">May 2025</option>
                        <option value="4">June 2025</option>
                      </select>
                    </div>
                    
                  </div>
                  <div id="sales-profit"></div>
                   
                
                  <div class="table-responsive products-tabel" data-simplebar>
                    <table class="table text-nowrap mb-0 align-middle table-hover">
                      <thead class="fs-4">
                        <tr>
                          <th class="fs-3 px-4">Nom et Prenom</th>
                          <th class="fs-3">Adress email</th>
                          <th class="fs-3">Contact</th>
                          <th class="fs-3">Date</th>
                          <th class="fs-3">service</th>
                          <th class="fs-3"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="d-flex align-items-center product">
                              <img src="../assets/images/products/s1.jpg" class="img-fluid flex-shrink-0 rounded"
                                width="60" height="60" />
                              <div class="ms-3 product-title">
                                <h6 class="fs-3 mb-0 text-truncate-2">
                                  iPhone 13 pro max-Pacific Blue-128GB storage
                                </h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <h5 class="mb-0 fs-4">
                              $180 <span class="text-muted">/499</span>
                            </h5>
                            <p class="text-muted mb-2">Partially paid</p>
                            <div class="progress bg-light w-100" style="height: 4px">
                              <div class="progress-bar bg-warning" role="progressbar" aria-label="Example 4px high"
                                style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            <span
                              class="badge rounded-pill fs-2 fw-medium bg-secondary-subtle text-secondary">Confirmed</span>
                          </td>
                          <td>
                            <div class="dropdown dropstart">
                              <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical fs-6"></i>
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-plus"></i>Add</a>
                                </li>
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-edit"></i>Edit</a>
                                </li>
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-trash"></i>Delete</a>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="d-flex align-items-center product">
                              <img src="../assets/images/products/s2.jpg" class="img-fluid flex-shrink-0 rounded"
                                width="60" height="60" />
                              <div class="ms-3 product-title">
                                <h6 class="fs-3 mb-0 text-truncate-2">
                                  Apple MacBook Pro 13 inch-M1-8/256GB-space
                                </h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <h5 class="mb-0 fs-4">
                              $120 <span class="text-muted">/499</span>
                            </h5>
                            <p class="text-muted mb-2">Full paid</p>
                            <div class="progress bg-light w-100" style="height: 4px">
                              <div class="progress-bar bg-success" role="progressbar" aria-label="Example 4px high"
                                style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            <span
                              class="badge rounded-pill fs-2 fw-medium bg-success-subtle text-success">Confirmed</span>
                          </td>
                          <td>
                            <div class="dropdown dropstart">
                              <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical fs-6"></i>
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-plus"></i>Add</a>
                                </li>
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-edit"></i>Edit</a>
                                </li>
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-trash"></i>Delete</a>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="d-flex align-items-center product">
                              <img src="../assets/images/products/s3.jpg" class="img-fluid flex-shrink-0 rounded"
                                width="60" height="60" />
                              <div class="ms-3 product-title">
                                <h6 class="fs-3 mb-0 text-truncate-2">
                                  PlayStation 5 DualSense Wireless Controller
                                </h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <h5 class="mb-0 fs-4">
                              $120 <span class="text-muted">/499</span>
                            </h5>
                            <p class="text-muted mb-2">Cancelled</p>
                            <div class="progress bg-light w-100" style="height: 4px">
                              <div class="progress-bar bg-danger" role="progressbar" aria-label="Example 4px high"
                                style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            <span
                              class="badge rounded-pill fs-2 fw-medium bg-danger-subtle text-danger">Cancelled</span>
                          </td>
                          <td>
                            <div class="dropdown dropstart">
                              <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical fs-6"></i>
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-plus"></i>Add</a>
                                </li>
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-edit"></i>Edit</a>
                                </li>
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-trash"></i>Delete</a>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="d-flex align-items-center product">
                              <img src="../assets/images/products/s5.jpg" class="img-fluid flex-shrink-0 rounded"
                                width="60" height="60" />
                              <div class="ms-3 product-title">
                                <h6 class="fs-3 mb-0 text-truncate-2">
                                  Amazon Basics Mesh, Mid-Back, Swivel Office
                                  De...
                                </h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <h5 class="mb-0 fs-4">
                              $120 <span class="text-muted">/499</span>
                            </h5>
                            <p class="text-muted mb-2">Partially paid</p>
                            <div class="progress bg-light w-100" style="height: 4px">
                              <div class="progress-bar bg-warning" role="progressbar" aria-label="Example 4px high"
                                style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            <span
                              class="badge rounded-pill fs-2 fw-medium bg-secondary-subtle text-secondary">Confirmed</span>
                          </td>
                          <td>
                            <div class="dropdown dropstart">
                              <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical fs-6"></i>
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-plus"></i>Add</a>
                                </li>
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-edit"></i>Edit</a>
                                </li>
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-trash"></i>Delete</a>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

                </div>
                
              </div>
            </div>


          <div class="body-wrapper-inner">
        <div class="container-fluid">
            <!--  Row 2-------------------------------------------------------------- -->
          <div class="row">
            <div class="col-lg-8 d-flex align-items-strech">
              <div class="card w-100">
                <div class="card-body">
                  <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                      <h5 class="card-title fw-semibold">Lise des Contact</h5>
                    </div>
                
                    
                  </div>
                  <div id="sales-profit"></div>
                   
                
                  <div class="table-responsive products-tabel" data-simplebar>
                    <table class="table text-nowrap mb-0 align-middle table-hover">
                      <thead class="fs-4">
                        <tr>
                          <th class="fs-3 px-4">Nom et Prenom</th>
                          <th class="fs-3">Adress email</th>
                          <th class="fs-3">Contact</th>
                          <th class="fs-3"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="d-flex align-items-center product">
                              <img src="../assets/images/products/s1.jpg" class="img-fluid flex-shrink-0 rounded"
                                width="60" height="60" />
                              <div class="ms-3 product-title">
                                <h6 class="fs-3 mb-0 text-truncate-2">
                                  iPhone 13 pro max-Pacific Blue-128GB storage
                                </h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <h5 class="mb-0 fs-4">
                              $180 <span class="text-muted">/499</span>
                            </h5>
                            <p class="text-muted mb-2">Partially paid</p>
                            <div class="progress bg-light w-100" style="height: 4px">
                              <div class="progress-bar bg-warning" role="progressbar" aria-label="Example 4px high"
                                style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            <span
                              class="badge rounded-pill fs-2 fw-medium bg-secondary-subtle text-secondary">Confirmed</span>
                          </td>
                          <td>
                            <div class="dropdown dropstart">
                              <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical fs-6"></i>
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-plus"></i>Add</a>
                                </li>
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-edit"></i>Edit</a>
                                </li>
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-trash"></i>Delete</a>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="d-flex align-items-center product">
                              <img src="../assets/images/products/s2.jpg" class="img-fluid flex-shrink-0 rounded"
                                width="60" height="60" />
                              <div class="ms-3 product-title">
                                <h6 class="fs-3 mb-0 text-truncate-2">
                                  Apple MacBook Pro 13 inch-M1-8/256GB-space
                                </h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <h5 class="mb-0 fs-4">
                              $120 <span class="text-muted">/499</span>
                            </h5>
                            <p class="text-muted mb-2">Full paid</p>
                            <div class="progress bg-light w-100" style="height: 4px">
                              <div class="progress-bar bg-success" role="progressbar" aria-label="Example 4px high"
                                style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            <span
                              class="badge rounded-pill fs-2 fw-medium bg-success-subtle text-success">Confirmed</span>
                          </td>
                          <td>
                            <div class="dropdown dropstart">
                              <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical fs-6"></i>
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-plus"></i>Add</a>
                                </li>
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-edit"></i>Edit</a>
                                </li>
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-trash"></i>Delete</a>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="d-flex align-items-center product">
                              <img src="../assets/images/products/s3.jpg" class="img-fluid flex-shrink-0 rounded"
                                width="60" height="60" />
                              <div class="ms-3 product-title">
                                <h6 class="fs-3 mb-0 text-truncate-2">
                                  PlayStation 5 DualSense Wireless Controller
                                </h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <h5 class="mb-0 fs-4">
                              $120 <span class="text-muted">/499</span>
                            </h5>
                            <p class="text-muted mb-2">Cancelled</p>
                            <div class="progress bg-light w-100" style="height: 4px">
                              <div class="progress-bar bg-danger" role="progressbar" aria-label="Example 4px high"
                                style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            <span
                              class="badge rounded-pill fs-2 fw-medium bg-danger-subtle text-danger">Cancelled</span>
                          </td>
                          <td>
                            <div class="dropdown dropstart">
                              <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical fs-6"></i>
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-plus"></i>Add</a>
                                </li>
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-edit"></i>Edit</a>
                                </li>
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-trash"></i>Delete</a>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="d-flex align-items-center product">
                              <img src="../assets/images/products/s5.jpg" class="img-fluid flex-shrink-0 rounded"
                                width="60" height="60" />
                              <div class="ms-3 product-title">
                                <h6 class="fs-3 mb-0 text-truncate-2">
                                  Amazon Basics Mesh, Mid-Back, Swivel Office
                                  De...
                                </h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <h5 class="mb-0 fs-4">
                              $120 <span class="text-muted">/499</span>
                            </h5>
                            <p class="text-muted mb-2">Partially paid</p>
                            <div class="progress bg-light w-100" style="height: 4px">
                              <div class="progress-bar bg-warning" role="progressbar" aria-label="Example 4px high"
                                style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            <span
                              class="badge rounded-pill fs-2 fw-medium bg-secondary-subtle text-secondary">Confirmed</span>
                          </td>
                          <td>
                            <div class="dropdown dropstart">
                              <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical fs-6"></i>
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-plus"></i>Add</a>
                                </li>
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-edit"></i>Edit</a>
                                </li>
                                <li>
                                  <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)"><i
                                      class="fs-4 ti ti-trash"></i>Delete</a>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

                </div>
                
              </div>
            </div>











          <div class="row">
            <div class="col-lg-4">
              <div class="card overflow-hidden hover-img">
                <div class="position-relative">
                  <a href="javascript:void(0)">
                    <img src="../assets/images/blog/blog-img1.jpg" class="card-img-top" alt="materialM-img">
                  </a>
                  <span
                    class="badge text-bg-light text-dark fs-2 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">2
                    min Read</span>
                  <img src="../assets/images/profile/user-3.jpg" alt="materialM-img"
                    class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9" width="40"
                    height="40" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Georgeanna Ramero">
                </div>
                <div class="card-body p-4">
                  <span class="badge text-bg-light fs-2 py-1 px-2 lh-sm  mt-3">Social</span>
                  <a class="d-block my-4 fs-5 text-dark fw-semibold link-primary" href="">Garmins Instinct Crossover is
                    a rugged hybrid smartwatch</a>
                  <div class="d-flex align-items-center gap-4">
                    <div class="d-flex align-items-center gap-2">
                      <i class="ti ti-eye text-dark fs-5"></i>9,125
                    </div>
                    <div class="d-flex align-items-center gap-2">
                      <i class="ti ti-message-2 text-dark fs-5"></i>3
                    </div>
                    <div class="d-flex align-items-center fs-2 ms-auto">
                      <i class="ti ti-point text-dark"></i>Mon, Dec 19
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card overflow-hidden hover-img">
                <div class="position-relative">
                  <a href="javascript:void(0)">
                    <img src="../assets/images/blog/blog-img2.jpg" class="card-img-top" alt="materialM-img">
                  </a>
                  <span
                    class="badge text-bg-light text-dark fs-2 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">2
                    min Read</span>
                  <img src="../assets/images/profile/user-2.jpg" alt="materialM-img"
                    class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9" width="40"
                    height="40" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Georgeanna Ramero">
                </div>
                <div class="card-body p-4">
                  <span class="badge text-bg-light fs-2 py-1 px-2 lh-sm  mt-3">Gadget</span>
                  <a class="d-block my-4 fs-5 text-dark fw-semibold link-primary" href="">Intel loses bid to revive
                    antitrust case
                    against patent foe Fortress</a>
                  <div class="d-flex align-items-center gap-4">
                    <div class="d-flex align-items-center gap-2">
                      <i class="ti ti-eye text-dark fs-5"></i>4,150
                    </div>
                    <div class="d-flex align-items-center gap-2">
                      <i class="ti ti-message-2 text-dark fs-5"></i>38
                    </div>
                    <div class="d-flex align-items-center fs-2 ms-auto">
                      <i class="ti ti-point text-dark"></i>Sun, Dec 18
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card overflow-hidden hover-img">
                <div class="position-relative">
                  <a href="javascript:void(0)">
                    <img src="../assets/images/blog/blog-img3.jpg" class="card-img-top" alt="materialM-img">
                  </a>
                  <span
                    class="badge text-bg-light text-dark fs-2 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">2
                    min Read</span>
                  <img src="../assets/images/profile/user-3.jpg" alt="materialM-img"
                    class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9" width="40"
                    height="40" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Georgeanna Ramero">
                </div>
                <div class="card-body p-4">
                  <span class="badge text-bg-light fs-2 py-1 px-2 lh-sm  mt-3">Health</span>
                  <a class="d-block my-4 fs-5 text-dark fw-semibold link-primary" href="">COVID outbreak deepens as more
                    lockdowns
                    loom in China</a>
                  <div class="d-flex align-items-center gap-4">
                    <div class="d-flex align-items-center gap-2">
                      <i class="ti ti-eye text-dark fs-5"></i>9,480
                    </div>
                    <div class="d-flex align-items-center gap-2">
                      <i class="ti ti-message-2 text-dark fs-5"></i>12
                    </div>
                    <div class="d-flex align-items-center fs-2 ms-auto">
                      <i class="ti ti-point text-dark"></i>Sat, Dec 17
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="py-6 px-6 text-center">
            <p class="mb-0 fs-4"> ©2025 CENTRE MÉDICAL PROTESTANT DE BAFOUSSAM.TOUS DROIT SRÉSERVÉS.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>