
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WORKLOG</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('template/images/logos/favicon.png')}}" />
  <link rel="stylesheet" href="{{asset('template/css/styles.min.css') }}" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
                <p class="text-center">Reporting Result Worklogs Employee</p>
                <p class="text-center">
                  From : {{$request->start_date}} To : {{$request->end_date}}
                </p>
                @php $no = 0; @endphp
                @foreach($loop as $loopKey => $loopItem)

                  @foreach($loopItem['project'] as $projectKey => $projectItem)
                  @php $no++; @endphp
                 @if($no > 0)
                 <br>
                 @endif
                    <ul>
                      <li>
                           Karyawan : 1
                      </li>
                      <li>
                           Project : 1
                      </li>
                    </ul>
                    <div class="table-responsive">
                    <table class="table-striped" style="width: 100%;">
                      <thead>
                        <tr>
                           <th>Tanggal</th>
                           <th>Jam</th>
                           <th>Value</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php 
                          $arr = []; 
                        @endphp
                        @foreach($data[$loopKey][$projectKey] as $tglKey => $tglItem)
                        <tr>
                          <td>
                            @if($tglKey != 'total' || $tglKey != 'jam')
                            {{$tglKey}}
                            @endif
                          </td>
                          <td>
                            @if(isset($data[$loopKey][$projectKey][$tglKey]['jam']))
                              {{$data[$loopKey][$projectKey][$tglKey]['jam']}}
                            @else
                            -
                              @php 
                                $arr[$tglKey] = $data[$loopKey][$projectKey][$tglKey]; 
                              @endphp
                            @endif
                          </td>
                            @if(isset($data[$loopKey][$projectKey][$tglKey]['value']))
                             {{$data[$loopKey][$projectKey][$tglKey]['value']}}
                            @else
                            -
                             @php 
                                $arr[$tglKey] = $data[$loopKey][$projectKey][$tglKey]; 
                              @endphp
                            @endif
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div align="center" class="col-md-12">
                      <ul>
                        @foreach($arr as $arrKey => $arrValue)
                        <li>
                          {{$arrKey}} : {{$arrValue}}
                        </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                  @endforeach
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{asset('template/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
  </script>
</body>

</html>