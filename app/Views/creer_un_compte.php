<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Créer un compte EEC Bafoussam</title>
  <link rel="shortcut icon" type="image/png" href="../ASSETS/IMAGES/logos/favicon.png" />
  <link rel="stylesheet" href="../ASSETS/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="<?=site_url('creer_un_compte');?>" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="../ASSETS/IMAGES/logos/favicon.png" alt="" width="80">CMPB
                </a>
                <p class="text-center">Centre Medicale Protestant de Bafoussam</p>

                <?php
                $validation = $validation ?? \Config\Services::validation();
                ?>


                <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success text-center">
                  <?= session()->getFlashdata('success')?></div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger text-center">
                  <?= session()->getFlashdata('error')?></div>
                <?php endif; ?>

                <form method="post" action="<?=base_url('Creer_compte/store');?>">
                  
                    <?= csrf_field()?>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nom et prenom</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name_surName">
                    <span class='text-danger'><?= $validation->getError('name_surName')?></span>
                  </div>
      
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Vrotre Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                    <span class='text-danger'><?= $validation->getError('email')?></span>
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputEmail1" class="form-label">telephone</label>
                    <input type="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="telephone">
                    <span class='text-danger'><?= $validation->getError('telephone')?></span>
                  </div>
                  <div class="mb-5">
                    <label for="exampleInputPassword1" class="form-label">Votre mot de passe</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="mot_de_passe">
                    <span class='text-danger'><?= $validation->getError('mot_de_passe')?></span>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        se souvenir de moi
                      </label>
                    </div>
                    <a class="text-primary fw-bold" href="./index.html">mot de passe oublie ?</a>
                  </div>
                  <a href="./index.html" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2"><button>Creer un compte</button></a>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Vous avez deja un compte?</p>
                    <a class="text-primary fw-bold ms-2" href="<?=site_url('sinscrire');?>">S'inscrire</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>