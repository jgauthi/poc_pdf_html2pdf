<?php
$user = [
    'id' => 1,
    'siret' => '152 356 785',
    'firstname' => 'John',
    'lastname' => 'Doe',
    'email' => 'john.doe@gmail.com',
    'portable' => '06.25.35.45.35',
    'address' => "26 Avenue du Bourg\n75000 Paris",
];

$client = [
    'id' => 1,
    'firstname' => 'Luc',
    'lastname' => 'Kennedy',
    'mail' => 'luc.kennedy@gmail.com',
    'portable' => '06.32.23.15.58',
    'address' => "5 Avenue du Boulevard Maréchal Juin\n14000 Caen",
    'infos' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium eos tempora, magni delectus porro cum labore eligendi.',
];

$project = [
    'id' => 1,
    'name' => "Création d'un Portfolio",
    'status' => 1,
    'infos' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium eos tempora, magni delectus porro cum labore eligendi.',
    'created' => 1,
    'paid' => false,
    'client_id' => 1,
    'user_id' => 1,
];

$tasks[] = [
    'id' => 1,
    'ref' => '96ER1',
    'description' => 'Veille technologique',
    'price' => 200,
    'quantity' => 1,
    'project_id' => 1,
];

$tasks[] = [
    'id' => 2,
    'ref' => '152DE',
    'description' => "Création et intégration d'un thème pour Wordpress",
    'price' => 500,
    'quantity' => 1,
    'project_id' => 1,
];

$tasks[] = [
    'id' => 3,
    'ref' => '25365',
    'description' => "Développement d'un plugin Wordpress sur mesure pour le client",
    'price' => 1000,
    'quantity' => 1,
    'project_id' => 1,
];

$total = 0;
$total_tva = 0;
?>

<style type="text/css">
    table {
        width: 100%;
        color: #717375;
        font-family: helvetica;
        line-height: 5mm;
        border-collapse: collapse;
    }
    h2  { margin: 0; padding: 0; }
    p { margin: 5px; }

    .border th {
        border: 1px solid #000;
        color: white;
        background: #000;
        padding: 5px;
        font-weight: normal;
        font-size: 14px;
        text-align: center; }
    .border td {
        border: 1px solid #CFD1D2;
        padding: 5px 10px;
        text-align: center;
    }
    .no-border {
        border-right: 1px solid #CFD1D2;
        border-left: none;
        border-top: none;
        border-bottom: none;
    }
    .space { padding-top: 250px; }

    .10p { width: 10%; } .15p { width: 15%; }
    .25p { width: 25%; } .50p { width: 50%; }
    .60p { width: 60%; } .75p { width: 75%; }
</style>

<page backtop="10mm" backleft="10mm" backright="10mm" backbottom="10mm" footer="page;">

    <page_footer>
        <hr />
        <p>Fait a Paris, le <?=date('d/m/y')?></p>
        <p>Signature du particulier, suivie de la mension manuscrite "bon pour accord".</p>
        <p>&nbsp;</p>
    </page_footer>

    <table style="vertical-align: top;">
        <tr>
            <td class="75p">
                <strong><?=$user['firstname'].' '.$user['lastname']?></strong><br />
                <?=nl2br($user['address'])?><br />
                <strong>SIRET:</strong> <?=$user['siret']?><br />
                <?=$user['email']?>
            </td>
            <td class="25p">
                <strong><?=$client['firstname'].' '.$client['lastname']?></strong><br />
                <?=nl2br($client['address'])?><br />
            </td>
        </tr>
    </table>

    <table style="margin-top: 50px;">
        <tr>
            <td class="50p"><h2>Devis n°14</h2></td>
            <td class="50p" style="text-align: right;">Emis le <?=date('d/m/y')?></td>
        </tr>
        <tr>
            <td style="padding-top: 15px;" colspan="2"><strong>Objectif:</strong> <?=$project['name']?></td>
        </tr>
    </table>

    <table style="margin-top: 30px;" class="border">
        <thead>
        <tr>
            <th class="60p">Description</th>
            <th class="10p">Quantité</th>
            <th class="15p">Prix Unitaire</th>
            <th class="15p">Montant</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?=$task['description']?></td>
                <td><?=$task['quantity']?></td>
                <td><?=$task['price']?> &euro;</td>
                <td><?php
                    $price_tva = $task['price'] * 1.2;
                    echo $price_tva;
                    ?>
                    &euro;</td>

                <?php
                $total += $task['price'];
                $total_tva += $price_tva;
                ?>
            </tr>
        <?php endforeach ?>

        <tr>
            <td class="space"></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td colspan="2" class="no-border"></td>
            <td style="text-align: center;" rowspan="3"><strong>Total:</strong></td>
            <td>HT : <?=$total?> &euro;</td>
        </tr>
        <tr>
            <td colspan="2" class="no-border"></td>
            <td>TVA : <?=$total_tva - $total?> &euro;</td>
        </tr>
        <tr>
            <td colspan="2" class="no-border"></td>
            <td>TTC : <?=$total_tva?> &euro;</td>
        </tr>
        </tbody>
    </table>

</page>