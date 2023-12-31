<form   
        class = "bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
        method="<?= $config["config"]["method"]??"GET" ?>"
        action="<?= $config["config"]["action"] ?>">

    <?php foreach ($config["inputs"] as $name=>$input):?>
        
        <?php if($input["type"] == "select"):?>
            <select name="<?= $name;?>">
                <?php foreach ($input["options"] as $option):?>
                    <option><?= $option;?></option>
                <?php endforeach;?>
            </select>
        <?php else: ?>
            <input
                    value="<?= $input["value"] ?? "" ?>"
                    name="<?= $name;?>"
                    type="<?= $input["type"]?>"
                    placeholder=" <?= $input["placeholder"]?>"
                    class= "<?= isset($input["class"]) ? $input["class"] : '' ?>"
            >
        <?php endif;?>

    <?php endforeach; ?>


    <input type="submit" name="submit" value="<?= $config["config"]["submit"] ?>">
</form>

