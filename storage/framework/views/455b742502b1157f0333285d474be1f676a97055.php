<?php $__env->startSection('content'); ?>
<style>
    table {
        font-size: 11px;
    }
</style>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Data Buku</h5>
                <br>
                <div>
                    <a href="<?php echo e(route('banner.create')); ?>" class="btn btn-primary btn-lg" style="margin-left: 25px">Tambah</a>
                </div>
                <br>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-borderer">
                            <thead class="table-dark">
                                <tr>
                                    <th style="color: white">No</th>
                                    <th style="color: white">Gambar</th>
                                    <th style="color: white">Aksi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <th><?php echo e($loop->iteration); ?></th>
                                        <th>
                                            <?php if($item->gambar != null): ?>
                                                <img src="<?php echo \Storage::url($item->gambar); ?>" width="100">
                                             <?php endif; ?>
                                        </th>
                                        <th>
                                            <a href="<?php echo e(route('banner.edit', $item->id)); ?>" class="btn btn-warning">Edit</a>
                                        </th>
                                        <th>
                                            <?php echo Form::open ([
                                                'route'=> ['banner.destroy', $item -> id],
                                                'method' => 'delete',
                                                'onsubmit'=> 'return confirm("yakin mau dihapus")',
                                           ]); ?>

                                           <button type="submit" class="btn btn-danger">Hapus</button>
                                           <?php echo Form::close(); ?>

                                        </th>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="12">Data tidak ada</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Volumes/Data/Punya Orang/Web Kunangan/kunangan/resources/views/banner_index.blade.php ENDPATH**/ ?>