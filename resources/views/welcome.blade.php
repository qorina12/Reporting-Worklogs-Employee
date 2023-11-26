
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WORKLOG</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('template/images/logos/favicon.png')}}" />
  <link rel="stylesheet" href="{{asset('template/css/styles.min.css') }}" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-12">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="{{asset('template/images/logos/favicon.png')}}" width="35" alt="">
                </a>
                <p class="text-center">Reporting Worklogs Employee</p>
                <form action="{{url('report')}}">
                  <div class="mb-3">
                    <label for="exampleInputtext12" class="form-label">Karyawan</label>
                    <select id="exampleInputEmail12" class="form-select js-example-basic-single" name="id_employee[]" multiple required>
                        <option value="" disabled>Pilih Karyawan</option>
                          @foreach($employee as $key => $item)
                            <option value="{{$item->id}}">{{$item->nama_karyawan}}</option>
                          @endforeach
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail13" class="form-label">Project</label>
                    <select id="exampleInputEmail13" class="form-select js-example-basic-single" multiple name="id_project[]" required>
                         <option value="" disabled>Pilih Project</option>
                          @foreach($project as $key => $item)
                            <option value="{{$item->id}}">{{$item->nama_project}}</option>
                          @endforeach
                    </select>
                  </div>
                  <div class="mb-3">
                    <div class="row">
                      <div class="col-md-6">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Awal</label>
                        <input required type="date" class="form-control" value="{{date('Y-m-d')}}" name="start_date">
                      </div>
                      <div class="col-md-6">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Akhir</label>
                        <input required type="date" class="form-control" value="{{date('Y-m-d')}}" name="end_date">
                      </div>
                    </div>
                    
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">SUBMIT</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{asset('template/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('template/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>

  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
  </script>
</body>

</html>