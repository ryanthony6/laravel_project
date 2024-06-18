<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <script src="<?php echo e(mix('js/app.js')); ?>"></script>
</head>
<body>
    <div class="container">
        <h1>Booking History</h1>
        <form method="GET" action="<?php echo e(url('/bookings')); ?>">
            <div class="filter-container">
                <input type="text" name="search" placeholder="Search by name or court" value="<?php echo e(request()->query('search')); ?>">
                <select name="court" value="<?php echo e(request()->query('court')); ?>">
                    <option value="">All Courts</option>
                    <!-- Example options, you might want to populate this dynamically -->
                    <option value="Court 1">Court 1</option>
                    <option value="Court 2">Court 2</option>
                </select>
                <button type="submit">Filter</button>
            </div>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Court</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($booking['id']); ?></td>
                        <td><?php echo e($booking['name']); ?></td>
                        <td><?php echo e($booking['court']); ?></td>
                        <td><?php echo e($booking['date']); ?></td>
                        <td><?php echo e($booking['time']); ?></td>
                        <td><?php echo e($booking['created_at']); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php /**PATH C:\Users\Leona\Documents\Backend_F\bookinghistory\resources\views/bookings/index.blade.php ENDPATH**/ ?>