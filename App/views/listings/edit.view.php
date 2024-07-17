<?= loadPartial('head'); ?>

<?= loadPartial('navbar'); ?>

<?= loadPartial('top-banner'); ?>

<!-- Update a Job Form Box -->
<section class="flex justify-center items-center mt-20">
    <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-600 mx-6">
        <h2 class="text-4xl text-center font-bold mb-4">Edit Job Listing</h2>
        <form method="POST" action="/listings">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                Job Info
            </h2>
            <?php if (isset($errors)) : ?>
                <div class="message bg-red-100 my-3">Some fields are incorrectly filled.</div>
            <?php endif; ?>
            <div class="mb-4">
                <input type="text" name="title" placeholder="Job Title" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= $listing->title ?? '' ?>" />
                <div class="message bg-red-100 my-3"> <?= $error['title'] ?? '' ?> </div>
            </div>
            <div class="mb-4">
                <textarea name="description" placeholder="Job Description" class="w-full px-4 py-2 border rounded focus:outline-none"><?= $listing->description ?? '' ?></textarea>
                <div class="message bg-red-100 my-3"> <?= $errors['description'] ?? '' ?> </div>
            </div>
            <div class="mb-4">
                <input type="text" name="salary" placeholder="Annual Salary" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= $listing->salary ?? '' ?>" />
                <div class="message bg-red-100 my-3"> <?= $errors['salary'] ?? '' ?> </div>
            </div>
            <div class="mb-4">
                <input type="text" name="requirements" placeholder="Requirements" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= $listing->requirements ?? '' ?>" />
                <div class="message bg-red-100 my-3"> <?= $errors['requirements'] ?? '' ?> </div>
            </div>
            <div class="mb-4">
                <input type="text" name="benefits" placeholder="Benefits" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= $listing->benefits ?? '' ?>" />
                <div class="message bg-red-100 my-3"> <?= $errors['benefits'] ?? '' ?> </div>
            </div>
            <div class="mb-4">
                <input type="text" name="tags" placeholder="Tags" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= $listing->tags ?? '' ?>" />
                <div class="message bg-red-100 my-3"> <?= $errors['tags'] ?? '' ?> </div>
            </div>
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                Company Info & Location
            </h2>
            <div class="mb-4">
                <input type="text" name="company" placeholder="Company Name" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= $listing->company ?? '' ?>" />
                <div class="message bg-red-100 my-3"> <?= $errors['company'] ?? '' ?> </div>
            </div>
            <div class="mb-4">
                <input type="text" name="address" placeholder="Address" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= $listing->address ?? '' ?>" />
                <div class="message bg-red-100 my-3"> <?= $errors['address'] ?? '' ?> </div>
            </div>
            <div class="mb-4">
                <input type="text" name="city" placeholder="City" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= $listing->city ?? '' ?>" />
                <div class="message bg-red-100 my-3"> <?= $errors['city'] ?? '' ?> </div>
            </div>
            <div class="mb-4">
                <input type="text" name="state" placeholder="State" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= $listing->state ?? '' ?>" />
                <div class="message bg-red-100 my-3"> <?= $errors['state'] ?? '' ?> </div>
            </div>
            <div class="mb-4">
                <input type="text" name="phone" placeholder="Phone" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= $listing->phone ?? '' ?>" />
                <div class="message bg-red-100 my-3"> <?= $errors['phone'] ?? '' ?> </div>
            </div>
            <div class="mb-4">
                <input type="email" name="email" placeholder="Email Address For Applications" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= $listing->email ?? '' ?>" />
                <div class="message bg-red-100 my-3"> <?= $errors['email'] ?? '' ?> </div>
            </div>
            <button class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none">
                Save
            </button>
            <a href="/listings/<?= $listing->id ?>" class="block text-center w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded focus:outline-none">
                Cancel
            </a>
        </form>
    </div>
</section>

<?= loadPartial('botton-banner'); ?>

<?= loadPartial('footer'); ?>