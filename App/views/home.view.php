<?= loadPartial('head'); ?>

<?= loadPartial('navbar'); ?>

<?= loadPartial('showcase-search'); ?>

<?= loadPartial('top-banner'); ?>



<!-- Job Listings -->
<section>
    <div class="container mx-auto p-4 mt-4">
        <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">Recent Jobs</div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <!-- Job Listing 1: Software Engineer -->
            <?php foreach ($listings as $job) : ?>
                <?= loadPartial('job-card', ['job' => $job]); ?>
            <?php endforeach; ?>
        </div>
        <a href="/listings" class="block text-xl text-center">
            <i class="fa fa-arrow-alt-circle-right"></i>
            Show All Jobs
        </a>
</section>

<?= loadPartial('botton-banner'); ?>

<?= loadPartial('footer'); ?>