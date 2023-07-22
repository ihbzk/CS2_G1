<form class="w-full" method="<?= $config["config"]["method"] ?? "GET" ?>" action="<?= $config["config"]["action"] ?>" enctype='multipart/form-data'>
    <div class="flex flex-wrap -mx-3 mb-6">
        <?php foreach ($config["inputs"] as $name => $input) : ?>
            <?php if ($input["type"] == "select") : ?>
                <?php if ($input["same"] == "yes") : ?>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="<?= $name; ?>" class="mt-5 block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            <?= $input["label"] ?>
                        </label>
                        <select class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-full focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 mb-3" name="<?= $name; ?>">
                            <option value="" disabled selected class="bg-white-700 hover:bg-white-500 focus:shadow-outline focus:outline-none text-red-500 font-normal py-2 px-6 rounded"><?= $input["pre-select"] ?></option>
                            <?php foreach ($input["options"] as $option) : ?>
                                <option class="bg-white-700 hover:bg-white-500 focus:shadow-outline focus:outline-none text-red-500 font-bold py-2 px-6 rounded"><?= $option; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php else : ?>
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label for="<?= $name; ?>" class="mt-5 ml-4 block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            <?= $input["label"] ?>
                        </label>
                        <select class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-full focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 mb-3" name="<?= $name; ?>">
                            <option value="" disabled selected class="bg-white-700 hover:bg-white-500 focus:shadow-outline focus:outline-none text-red-500 font-normal py-2 px-6 rounded"><?= $input["pre-select"] ?></option>
                            <?php foreach ($input["options"] as $option) : ?>
                                <option class="bg-white-700 hover:bg-white-500 focus:shadow-outline focus:outline-none text-red-500 font-bold py-2 px-6 rounded"><?= $option; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>
            <?php elseif ($input["type"] == "checkbox") : ?>
                <div class="w-full flex px-3 mb-6 md:mb-0">
                    <label for="<?= $name; ?>" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mr-2" for="grid-first-name">
                        <?= $input["label"] ?>
                    </label>
                    <input class="rounded-full" name="<?= $name; ?>" type="<?= $input["type"] ?>" placeholder=" <?= $input["placeholder"] ?>" value="<?= $input['value'] ?>">
                </div>
            <?php elseif ($input["type"] == "password") : ?>
                <?php if ($input["same"] == "yes") : ?>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="mt-5 ml-4 block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            <?= $input["label"] ?>
                        </label>
                        <div class="relative">
                            <i class="fas fa-eye absolute right-0 top-0 mt-4 mr-4 cursor-pointer" id="show-password"></i>
                            <input class="border rounded-full appearance-none block w-full bg-white text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-3" name="<?= $name; ?>" type="password" placeholder="<?= $input["placeholder"] ?>" value="<?= $input['value'] ?>" id="password">
                        </div>
                    </div>
                <?php else : ?>
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="mt-5 ml-4 block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            <?= $input["label"] ?>
                        </label>
                        <div class="relative">
                            <i class="fas fa-eye absolute right-0 top-0 mt-4 mr-4 cursor-pointer" id="show-password"></i>
                            <input class="border rounded-full appearance-none block w-full bg-white text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-3" name="<?= $name; ?>" type="password" placeholder="<?= $input["placeholder"] ?>" value="<?= $input['value'] ?>" id="password">
                        </div>
                    </div>
                <?php endif; ?>
            <?php elseif ($name === 'thumbnail') : ?>
                <div class="w-full px-3 mb-6 md:mb-0">
                    <label for="thumbnail" class="mt-5 ml-4 block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        <?= $config["inputs"]["thumbnail"]["label"] ?>
                    </label>
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*">
                </div>
            <?php elseif ($name === 'cover_image') : ?>
                <div class="w-full px-3 mb-6 md:mb-0">
                    <label for="cover_image" class="mt-5 ml-4 block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        <?= $config["inputs"]["cover_image"]["label"] ?>
                    </label>
                    <input type="file" name="cover_image" id="cover_image" accept="image/*">
                </div>
            <?php elseif ($input["same"] == "yes") : ?>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label for="<?= $name; ?>" class="mt-5 ml-4 block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                        <?= $input["label"] ?>
                    </label>
                    <input class="border rounded-full appearance-none block w-full bg-white text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-3" name="<?= $name; ?>" type="<?= $input["type"] ?>" placeholder=" <?= $input["placeholder"] ?>" value="<?= $input['value'] ?>">
                </div>
            <?php else : ?>
                <div class="w-full px-3 mb-6 md:mb-0">
                    <label for="<?= $name; ?>" class="mt-5 ml-4 block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                        <?= $input["label"] ?>
                    </label>
                    <input class="border rounded-full appearance-none block w-full bg-white text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-3" name="<?= $name; ?>" type="<?= $input["type"] ?>" placeholder=" <?= $input["placeholder"] ?>" value="<?= $input['value'] ?>">
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <div class="w-full px-3 pt-6 mb-6 md:mb-0 flex w-full justify-center items-center">
            <a href="<?= toRootPath($config["config"]["location"]); ?>" class="shadow bg-red-700 hover:bg-red-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-6 mr-2 rounded-full cursor-pointer" aria-label="Retour"><?= $config["config"]["cancel"] ?></a>
            <input class="shadow bg-red-700 hover:bg-red-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-6 rounded-full cursor-pointer" type="submit" name="submit" value="<?= $config["config"]["submit"] ?>">
        </div>
    </div>
</form>