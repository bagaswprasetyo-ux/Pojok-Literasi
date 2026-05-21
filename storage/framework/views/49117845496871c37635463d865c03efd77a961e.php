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
                    <a href="<?php echo e(route('buku.create')); ?>" class="btn btn-primary btn-lg" style="margin-left: 25px">Tambah</a>
                </div>
                <br>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-borderer">
                            <thead class="table-dark">
                                <tr>
                                    <th style="color: white">No</th>
                                    <th style="color: white">Foto</th>
                                    <th style="color: white">Judul</th>
                                    <th style="color: white">pengarang</th>
                                    <th style="color: white">Lokasi</th>
                                    <th style="color: white">Deskripsi</th>
                                    <th style="color: white">Status</th>
                                    <th style="color: white">Aksi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $buku; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <th><?php echo e($loop->iteration); ?></th>
                                        <th>
                                            <?php if($item->foto != null): ?>
                                                <img src="<?php echo \Storage::url($item->foto); ?>" width="100">
                                             <?php endif; ?>
                                        </th>
                                        <th><?php echo e($item->judul); ?></th>
                                        <th><?php echo e($item->pengarang); ?></th>
                                        <th><?php echo e($item->lokasi->lokasi); ?></th>
                                        <th><?php echo e($item->deskripsi); ?></th>
                                        <th><?php echo e($item->status); ?></th>
                                        <th>
                                            <a href="<?php echo e(route('buku.edit', $item->id)); ?>" class="btn btn-warning">Edit</a>
                                        </th>
                                        <th>
                                            <?php echo Form::open ([
                                                'route'=> ['buku.destroy', $item -> id],
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

<?php echo $__env->make('layouts.app_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Volumes/Data/Punya Orang/Web Kunangan/kunangan/resources/views/buku_index.blade.php ENDPATH**/ ?>