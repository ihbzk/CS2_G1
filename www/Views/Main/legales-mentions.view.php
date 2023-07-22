<div class="max-w-screen-md mx-auto p-5 m-5 mb-10">
    <div class="text-center">
        <h1 class="text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black pt-2 pb-5">Mentions légales (fictives)</h1>
        <p class="mx-auto text-base text-gray-500 text-justify"><i>En vertu de l'article 6 de la loi n° 2004-575 du 21 juin 2004 pour la confiance dans l'économie numérique, il est précisé aux utilisateurs du site <a href="<?= toRootPath(''); ?>" target="_blank"><a href="<?= toRootPath(''); ?>" target="_blank"><strong><?= $company_website ?></strong></a></a> l'identité des différents intervenants dans le cadre de sa réalisation et de son suivi.</i></p>
    </div>
</div>
<div class="mx-10 px-4 sm:px-8">
    <div class="py-4 border-4 p-5 m-5 border-red-700">
        <h2 class="mt-5 block uppercase tracking-wide text-gray-700 text-xl font-bold mb-2 text-center">Propriétaire : <strong><?= $company_name ?></strong></h2>
        <hr class="mb-5">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <h3 class="mt-5 block uppercase tracking-wide text-gray-700 text-sm font-bold mb-2">Statut</h3>
                <p class="mx-auto text-base text-gray-500 text-justify">
                    <?= $company_status ?>
                </p>
                <h3 class="mt-5 block uppercase tracking-wide text-gray-700 text-sm font-bold mb-2">SIRET</h3>
                <p class="mx-auto text-base text-gray-500 text-justify">
                    <?= $company_siret ?>
                </p>
                <h3 class="mt-5 block uppercase tracking-wide text-gray-700 text-sm font-bold mb-2">Adresse</h3>
                <p class="mx-auto text-base text-gray-500 text-justify">
                    <a href="http://maps.google.com/?q=<?= $company_address . ', ' . $company_zipcode . ' ' . $company_city ?>" target="_blank"><?= $company_address . ', ' . $company_zipcode . ' ' . $company_city ?></a>
                </p>
                <h3 class="mt-5 block uppercase tracking-wide text-gray-700 text-sm font-bold mb-2">Téléphone</h3>
                <p class="mx-auto text-base text-gray-500 text-justify">
                    <a href="tel:<?= $company_phone_link ?>"><?= $company_phone ?></a>
                </p>
                <h3 class="mt-5 block uppercase tracking-wide text-gray-700 text-sm font-bold mb-2">Email</h3>
                <p class="mx-auto text-base text-gray-500 text-justify">
                    <a href="mailto:<?= $company_email ?>"><?= $company_email ?></a>
                </p>
                <h3 class="mt-5 block uppercase tracking-wide text-gray-700 text-sm font-bold mb-2">Directeurs de la publication</h3>
                <p class="mx-auto text-base text-gray-500 text-justify">
                    <?= $company_director_name ?>
                </p>
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 flex items-center justify-center">
                <img src="<?= $company_logo ?>" alt="Logo de du propriétaire <?= $company_name ?>" class="max-w-[50%] h-full object-contain">
            </div>
        </div>
    </div>
    <div class="py-4 border-4 p-5 m-5 border-red-700">
        <h2 class="mt-5 block uppercase tracking-wide text-gray-700 text-xl font-bold mb-2 text-center">Hébergeur : <?= $host_name ?></h2>
        <hr class="mb-5">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <h3 class="mt-5 block uppercase tracking-wide text-gray-700 text-sm font-bold mb-2">SIRET</h3>
                <p class="mx-auto text-base text-gray-500 text-justify">
                    <?= $host_siret ?>
                </p>
                <h3 class="mt-5 block uppercase tracking-wide text-gray-700 text-sm font-bold mb-2">Adresse</h3>
                <p class="mx-auto text-base text-gray-500 text-justify">
                    <a href="http://maps.google.com/?q=<?= $host_address . ', ' . $host_zipcode . ' ' . $host_city ?>" target="_blank"><?= $host_address . ', ' . $host_zipcode . ' ' . $host_city ?></a>
                </p>
                <h3 class="mt-5 block uppercase tracking-wide text-gray-700 text-sm font-bold mb-2">Téléphone</h3>
                <p class="mx-auto text-base text-gray-500 text-justify">
                    <a href="tel:<?= $host_phone_link ?>"><?= $host_phone ?></a>
                </p>
                <h3 class="mt-5 block uppercase tracking-wide text-gray-700 text-sm font-bold mb-2">Directeurs de la publication</h3>
                <p class="mx-auto text-base text-gray-500 text-justify">
                    <?= $host_director_name ?>
                </p>
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 flex items-center justify-center">
                <img src="<?= $host_logo ?>" alt="Logo de du propriétaire <?= $host_name ?>" class="max-w-[50%] h-full object-contain">
            </div>
        </div>
    </div>
    <div class="py-4 border-4 p-5 m-5 border-red-700">
        <h2 class="mt-5 block uppercase tracking-wide text-gray-700 text-xl font-bold mb-2 text-center">Conditions d'utilisation</h2>
        <hr class="mb-5">
        <p class="mx-auto text-base text-gray-500 text-justify">L'utilisation du site <a href="<?= toRootPath(''); ?>" target="_blank"><strong><?= $company_website ?></strong></a> implique l'acceptation pleine et entière des conditions générales d'utilisation décrites ci-après. Ces conditions d'utilisation sont susceptibles d'être modifiées ou complétées à tout moment, les utilisateurs du site <a href="<?= toRootPath(''); ?>" target="_blank"><strong><?= $company_website ?></strong></a> sont donc invités à les consulter de manière régulière.</p>
        <p class="mx-auto text-base text-gray-500 text-justify">Ce site est accessible à tout moment aux utilisateurs. Une interruption pour raison de maintenance technique peut être toutefois décidée par <strong><?= $company_name ?></strong>, qui s'efforcera alors de communiquer préalablement aux utilisateurs les dates et heures de l'intervention.</p>
    </div>
    <div class="py-4 border-4 p-5 m-5 border-red-700">
        <h2 class="mt-5 block uppercase tracking-wide text-gray-700 text-xl font-bold mb-2 text-center">Propriété intellectuelle</h2>
        <hr class="mb-5">
        <p class="mx-auto text-base text-gray-500 text-justify"><strong><?= $company_name ?></strong> est propriétaire des droits de propriété intellectuelle et détient les droits d'usage sur tous les éléments accessibles sur le site, notamment les textes, images, graphismes, logo, icônes, sons, logiciels, etc. Toute reproduction, représentation, modification, publication, adaptation de tout ou partie des éléments du site, quel que soit le moyen ou le procédé utilisé, est interdite, sauf autorisation écrite préalable de <strong><?= $company_name ?></strong>.</p>
    </div>
    <div class="py-4 border-4 p-5 m-5 border-red-700">
        <h2 class="mt-5 block uppercase tracking-wide text-gray-700 text-xl font-bold mb-2 text-center">Collecte et traitement des données</h2>
        <hr class="mb-5">
        <p class="mx-auto text-base text-gray-500 text-justify">Le site <a href="<?= toRootPath(''); ?>" target="_blank"><strong><?= $company_website ?></strong></a> met en œuvre des mesures appropriées pour protéger la confidentialité et la sécurité des données personnelles des utilisateurs. Les données collectées sont nécessaires à la gestion des commandes, à la fourniture des services proposés par <strong><?= $company_name ?></strong> et à la communication avec les utilisateurs. Conformément à la loi relative à l'informatique, aux fichiers et aux libertés du 6 janvier 1978, les utilisateurs disposent d'un droit d'accès, de rectification, de suppression et d'opposition de leurs données personnelles. Pour exercer ces droits, les utilisateurs peuvent contacter <strong><?= $company_name ?></strong> via les coordonnées fournies dans les présentes mentions légales.</p>
    </div>
    <div class="py-4 border-4 p-5 m-5 border-red-700">
        <h2 class="mt-5 block uppercase tracking-wide text-gray-700 text-xl font-bold mb-2 text-center">Responsabilité</h2>
        <hr class="mb-5">
        <p class="mx-auto text-base text-gray-500 text-justify"><strong><?= $company_name ?></strong> ne pourra être tenu responsable des dommages directs et indirects causés au matériel de l'utilisateur lors de l'accès au site <a href="<?= toRootPath(''); ?>" target="_blank"><strong><?= $company_website ?></strong></a>, et résultant soit de l'utilisation d'un matériel ne répondant pas aux spécifications indiquées, soit de l'apparition d'un bug ou d'une incompatibilité.</p>
        <p class="mx-auto text-base text-gray-500 text-justify"><strong><?= $company_name ?></strong> ne pourra également être tenu responsable des dommages indirects (tels que perte de marché ou perte d'une chance) consécutifs à l'utilisation du site <a href="<?= toRootPath(''); ?>" target="_blank"><strong><?= $company_website ?></strong></a>.</p>
        <p class="mx-auto text-base text-gray-500 text-justify">Les liens hypertextes présents sur le site <a href="<?= toRootPath(''); ?>" target="_blank"><strong><?= $company_website ?></strong></a> peuvent renvoyer vers d'autres sites web. <strong><?= $company_name ?></strong> décline toute responsabilité quant au contenu de ces sites et aux éventuels préjudices pouvant en découler.</p>
    </div>
    <div class="py-4 border-4 p-5 m-5 border-red-700">
        <h2 class="mt-5 block uppercase tracking-wide text-gray-700 text-xl font-bold mb-2 text-center">Législation applicable et attribution de juridiction</h2>
        <hr class="mb-5">
        <p class="mx-auto text-base text-gray-500 text-justify">Tout litige en relation avec l'utilisation du site <a href="<?= toRootPath(''); ?>" target="_blank"><strong><?= $company_website ?></strong></a> est soumis au droit français. Il est fait attribution exclusive de juridiction aux tribunaux compétents.</p>
    </div>
</div>