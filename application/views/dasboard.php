 <div class="row">
     <div class="task-widget2">
        <div class="task-image">
         <img src="<?= base_url('assets/template') ?>/plugins/images/task.jpg" alt="task" class="img-responsive">
         <div class="task-image-overlay"></div>
         <div class="task-detail">
            <h2 class="font-light text-white m-b-0"><?= $this->config->item('selamat_datang') ?></h2>
            <small class="font-normal text-white m-t-5"><?= $this->config->item('deskripsi') ?></small>
        </div>
        <div class="task-add-btn">
            <a href="<?= base_url('Crud_create') ?>" class="btn btn-success">+</a>
        </div>
    </div>
</div>

<br />
<br />
<!-- row -->
<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="white-box">
            <h3 class="box-title">Data notulen by status </h3>
            <ul class="list-inline text-right">
                <li>
                    <h5><i class="fa fa-circle text-info m-r-5"></i>open by agenda</h5> </li>
                    <li>
                        <h5><i class="fa fa-circle text-warning m-r-5"></i>closed by agenda</h5> </li>
                    </ul>
                    <div id="morris-area-chart"></div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="white-box">
                    <h3 class="box-title">Data notulen by status </h3>
                    <ul class="list-inline text-right">
                        <li>
                            <h5><i class="fa fa-circle text-info m-r-5"></i>open by agenda</h5> </li><li>
                              <h5><i class="fa fa-circle text-info m-r-5"></i>open by agenda</h5> </li>
                          </ul>
                          <div id="morris-area-chart2"></div>
                      </div>
                  </div>
              </div>
              

              <script type="text/javascript">
                $(function() {

                    "use strict";

    // Dashboard 1 Morris-chart

    Morris.Area({
        element: 'morris-area-chart',
        data: [
        
        <?php foreach($agenda_by_status->result_array() as $agen_by): ?>
            {
                period: '<?= $agen_by['date_created'] ?>',
                open: <?= $agen_by['open'] ?>,
                closed: <?= $agen_by['closed'] ?>,
            },
        <?php endforeach; ?>    

        ],
        xkey: 'period',
        ykeys: ['open', 'closed'],
        labels: ['open', 'closed'],
        pointSize: 3,
        fillOpacity: 0,
        pointStrokeColors: ['#00bbd9', '#ffb136', '#4a23ad'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth: 1,
        hideHover: 'auto',
        lineColors: ['#00bbd9', '#ffb136', '#4a23ad'],
        resize: true

    });

    Morris.Area({
        element: 'morris-area-chart2',
        data: [ 

        <?php foreach($agenda_by_status->result_array() as $dataqr): ?>
            {
                period: '<?= $dataqr['date_created'] ?>',
                sopen: <?= $dataqr['open'] ?>,
                sclosed: <?= $dataqr['closed'] ?>,
            },
        <?php endforeach; ?>    
        ],
        xkey: 'period',
        ykeys: ['sopen', 'sclosed'],
        labels: ['sopen', 'sclosed'],
        pointSize: 0,
        fillOpacity: 0.4,
        pointStrokeColors: ['#ffb136', '#00bbd9'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth: 0,
        smooth: false,
        hideHover: 'auto',
        lineColors: ['#ffb136', '#00bbd9'],
        resize: true

    });
});

</script>                 