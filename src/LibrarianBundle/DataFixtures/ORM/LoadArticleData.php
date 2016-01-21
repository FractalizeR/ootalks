<?php

namespace FractalizeR\LibrarianBundle\LibrarianBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use FractalizeR\LibrarianBundle\Logic\Article\Entity\Article;

/**
 * Class LoadArticleData
 *
 * @package FractalizeR\LibrarianBundle\LibrarianBundle\DataFixtures\ORM
 */
class LoadArticleData implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $article = new Article($faker->sentence(), $this->getArticleText($faker));
            $manager->persist($article);
        }
        $manager->flush();
    }

    public function getArticleText(Generator $faker)
    {

        $header1 = $faker->sentence();
        $header2 = $faker->sentence();

        $articleText =
            <<<ARTICLE
# $header1

## $header2

Lorem markdownum parte, **ad** harena clausit: quae nullo magnae. Sunt timentem
virorum. Tu autem de limite valentior ullis nives, sole dixit, rasilis his
viridesque. Te [equique merui ovantem](http://haskell.org/) deus caespite.

``` php
addressSearch += server_hfs;
debuggerAlphaIcq.blacklist(575642 + memoryFddi(rte_ipod_analyst, -1),
        wpaDocument * floatingSubnet);
if (unix_ipx_version.webcamWebsiteToken.gateway(componentUltra, asp, 1) <=
        flashVdslEbook) {
    lion_telecommunications_wheel.serialFileRom += sql;
} else {
    crossplatform_card += fullFileHeuristic - warmIconMacro;
    dsl.online_boot = point + serverBitMemory(aspUncOverwrite, right,
            real_lamp);
    bittorrentAddressDdr(bounce_schema, drive);
}
var bookmark_key = outputCompression.scsi(link_primary_error);
```

## Mentem oro herbida mihi has nihil lapillos

Hymenaee et victa Argolica respiramina nomen aditu eam gemma tantum. Fera in
quid **nihil** cervix inde; turis velocibus conplexa.

## Sanguine miseranda rore

Ore quam, deos nitido Andraemon terris gravitate nati manusque fert; dolendi.
Fiuntque et Iolao *totumque*; virisque aquas et nomina et **ut** videt, te
cristis ipse. Vero audaci querorque sanguine roganti reclusa, niveis esse
pignora duxere. Nodosque moderere Titan illis dilacerant, herba *memorant*
nostris.

## Et crescendo vectus adgreditur

Secura vel tua cumque fuisses natura, dederant cunctisque illa, utraque. Mortali
hanc motu nec templi intrat! Iove simul cervus meorum?

## Semiferos non

*Pedibus* credule sibi Delius pennas condebat qua visus echidnae gurgite septem.
Pro conata felix Aetna frustra quantum? Cuius non magnumque corpore; faucibus
nudos hos at redeuntque foedus armento parabat habet amplexibus manus armigerae.
Me neque famulos terras iniuria, nullis corpora forma *per*, iam coronae crura
paenitet utraque fagus contra. Veri a superis Heliadum totidem Cyllaron formae
toro umeri superest, quamlibet.

    ```php
    dns = 2 + accessUnmountTft - nanometer_wan;
    if (ofRestoreHdd == encoding_pram_subdirectory) {
        mysql.device -= ram_dos;
        lossy.favorites_matrix_https(toslink_visual_rdf + rpmCmyk);
        retina_lion = dramHsf;
    } else {
        solid += progressivePcmcia(2, appletVirus, hard_gps_byte);
        overclocking_mp = wikiDdl;
        interpreter_keylogger.clipboard_markup = 1;
    }
    phishingNavigation = 3;
    ```

Mihi acta gratia, sagittas loqui, monimenta tamen et Aeacus. Nomina unum imber
inpiger bellum gravis gravis ideoque nova sub strenua suum.
ARTICLE;

        return $articleText;
    }
}
