<style>
    .circulos {
        width:100px;
        height:100px;
        border-radius:50%;
        font-size: 30px;
        padding-top: 25px;
    }
</style>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:1250px;">
    <div class="modal-content" style="padding:10px;">
      <div class="row">
        <div class="col-md-4">
            <h4 class="modal-unidade-nome"></h4>
            <p class="modal-unidade-bloco"></p>
            <p class="modal-unidade-cpf"></p>
        </div>
        <div class="col-md-8" style="padding-top:10px;">
            <div class="row">
                <div class="col-md-4 modal-media-mensal">
                    <div class="bg-info text-center circulos">
                        -
                    </div>
                    Média mensal
                </div>
                <div class="col-md-4 modal-media-anual">
                    <div class="bg-info text-center circulos">
                        -
                    </div>
                    Média Este ano
                </div>
                <div class="col-md-4 modal-este-mes">
                    <div class="bg-info text-center circulos">
                        -
                    </div>
                    Este mês
                </div>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-mb-12 grafico">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        <h3 class="card-title text-center">Comparativo de consumo <a href="#" class="btn btn-info" style="float:right; margin-right:20px;">Ver mais</a></h3>

                        <!--div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i></button>
                        </div-->
                        </div>
                        <div class="card-body">
                        <div class="chart">
                            <canvas id="barChartModal" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>