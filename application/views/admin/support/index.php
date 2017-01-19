<div class="row">
  <div class="col-lg-12">
    <div role="tabpanel">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#nowe" aria-controls="nowe" role="tab" data-toggle="tab">Nowe</a></li>
          <li role="presentation"><a href="#rozpatrzone" aria-controls="rozpatrzone" role="tab" data-toggle="tab">Rozpatrzone</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="nowe">
              <table class="table table_hover">
                        <thead>
                          <tr>
                            <th>Od</th>
                            <th>Date</th>
                            <th>Answer</th>
                          </tr>
                        </thead>
                        <tbody>
                    <?php if(count($support_new)): foreach($support_new as $application): ?> 
                        <tr>
                          <td><?php echo e($application->email); ?></td>
                          <td><?php echo e($application->send_date); ?></td>
                          <td>
                            <a href="<?php echo site_url() . 'admin/support/answer/' . $application->id; ?>">
                              <button type="button" class="btn btn-primary">
                                Odpowiedz
                              </button>
                            </a>  
                          </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                          <td colspan="3">We could not find any application.</td>
                        </tr>
                    <?php endif; ?> 
                        </tbody>
              </table>
          </div>
          <div role="tabpanel" class="tab-pane" id="rozpatrzone">
            <table class="table table_hover">
                        <thead>
                          <tr>
                            <th>From</th>
                            <th>Date</th>
                            <th>Answer by</th>
                            <th>Answer date</th>
                            <th>Show</th>
                          </tr>
                        </thead>
                        <tbody>
                    <?php if(count($support_answered)): foreach($support_answered as $supp_answered): ?> 
                        <tr>
                          <td><?php echo e($supp_answered->email); ?></td>
                          <td><?php echo e($supp_answered->send_date); ?></td>
                          <td><?php echo e($supp_answered->who_answer); ?></td>
                          <td><?php echo e($supp_answered->answer_date); ?></td>
                          <td><?php echo anchor('admin/support/show_answered/' . $supp_answered->id,'Show') ?></td>
                          
                        </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                          <td colspan="3">We could not find any application.</td>
                        </tr>
                    <?php endif; ?> 
                        </tbody>
              </table>
          </div>
        </div>

      </div>
  </div>
</div>
