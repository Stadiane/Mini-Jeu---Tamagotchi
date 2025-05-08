<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mini Jeu - Tamagotchi</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background: #fefae0;
    margin: 0;
    padding: 20px;
    color: #333;
    line-height: 1.6;
}

h1, h2, h3 {
    color: #606c38;
}

.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    background: #bc6c25;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
}

.top-bar div {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

button {
    padding: 10px 15px;
    background: #bc6c25;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s ease;
    margin: 5px;
}

button:hover {
    background: #dda15e;
}

button:disabled {
    background: #ddd;
    cursor: not-allowed;
}

button:active {
    background: #bc6c25;
    transform: scale(0.98);
}

.messages {
    padding: 15px;
    background: #fff3cd;
    border: 1px solid #ffeeba;
    border-radius: 5px;
    margin-bottom: 20px;
    font-weight: bold;
}

.messages div {
    color: red;
    background-color: yellow;
    padding: 10px;
    border-radius: 5px;
    margin-top: 10px;
}

.animal-card, .provision-card {
    background: white;
    border: 1px solid #ccc;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease, transform 0.3s ease;
    display: inline-block;
    width: 220px;
    text-align: center;
    vertical-align: top;
}

.animal-card:hover, .provision-card:hover {
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    transform: translateY(-5px);
}

.animal-card h3, .provision-card h3 {
    color: #606c38;
    font-size: 1.2rem;
    margin-bottom: 10px;
}

.animal-card ul {
    list-style-type: none;
    padding: 0;
}

.animal-card li {
    margin: 5px 0;
}

.provision-card span {
    display: block;
    margin: 8px 0;
    font-size: 0.9rem;
    color: #606c38;
}

.section {
    margin-bottom: 40px;
}

input[type="text"], select {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-right: 10px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

input[type="text"]:focus, select:focus {
    border-color: #bc6c25;
    outline: none;
}

form {
    margin: 15px 0;
}

.top-bar div form {
    margin-left: 10px;
}

h2 {
    font-size: 1.5rem;
    color: #606c38;
}

h3 {
    font-size: 1.1rem;
    color: #606c38;
}


    </style>
</head>
<div class="top-bar">
    <div>
        <strong>Jour :</strong> <?= $game->getDays() ?> |
        <strong>Points d'action :</strong> <?= $game->getPoints() ?>
    </div>

    <div>
        <form action="index.php" method="post" style="display:inline;">
            <input type="hidden" name="step" value="night">
            <button type="submit">🌙 Passer la nuit</button>
        </form>
        <form action="index.php" method="post" style="display:inline;">
            <input type="hidden" name="step" value="reset">
            <button type="submit">🔄 Recommencer</button>
        </form>
    </div>
</div>

<!-- Créer un animal -->
<div class="section">
    <h2>🐣 Créer un nouvel animal</h2>
    <form action="index.php" method="post">
        <input type="hidden" name="step" value="createAnimal">
        Nom : <input type="text" name="name" required>
        Icône :
        <select name="icon">
            <option>🦁</option><option>🙉</option><option>🐶</option>
            <option>🐱</option><option>🦝</option><option>🐹</option><option>🐼</option><option>🫎</option><option>🫏</option>
            <option>🦄</option><option>🐔</option><option>🐆</option><option>🐕</option>
        </select>
        <button type="submit" <?= $game->getPoints() < 1 ? 'disabled' : '' ?>>Ajouter </button>
    </form>
</div>

<!-- Chercher provisions -->
<div class="section">
    <form action="index.php" method="post">
        <input type="hidden" name="step" value="searchProvisions">
        <button type="submit" <?= $game->getPoints() < 1 ? 'disabled' : '' ?>>🔍 Chercher provisions</button>
    </form>
</div>

<!-- Liste des animaux -->
<div class="section">
    <h2>🐾 Mes animaux</h2>
    <?php foreach ($game->getAnimals() as $index => $animal): ?>
        <div class="animal-card">
            <h3><?= $animal->getIcon() ?> <?= $animal->getName() ?> </h3>
            <ul>
            
                <li>🕒 Age : <?= $animal->getAge() ?> Jours</li>
                <li>❤️ Santé : <?= $animal->getHealth() ?></li>
                <li>😊 Humeur : <?= $animal->getMood() ?></li>
                <li>🍖 Faim : <?= $animal->getHunger() ?></li>
                <li>💧 Soif : <?= $animal->getThirst() ?></li>
            </ul>

            <form action="index.php" method="post">
                <input type="hidden" name="step" value="feed">
                <input type="hidden" name="animal" value="<?= $index ?>">
                <select name="provision" required>
                    <?php foreach ($game->getProvision() as $pIndex => $provision): ?>
                        <option value="<?= $pIndex ?>">
                            <?= $provision->getIcon() ?> <?= $provision->getName() ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" <?= $game->getPoints() < 1 ? 'disabled' : '' ?>>🍽️ Nourrir </button>
            </form>

            <form action="index.php" method="post" style="display:inline;">
                <input type="hidden" name="step" value="heal">
                <input type="hidden" name="animal" value="<?= $index ?>">
                <button type="submit" <?= $game->getPoints() < 3 ? 'disabled' : '' ?>>🩹 Soigner </button>
            </form>

            <form action="index.php" method="post" style="display:inline;">
                <input type="hidden" name="step" value="caress">
                <input type="hidden" name="animal" value="<?= $index ?>">
                <button type="submit" <?= $game->getPoints() < 2 ? 'disabled' : '' ?>>🤗 Caresser </button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

<!-- Provisions -->
<div class="section">
    <h2>🎒 Provisions</h2>
    <?php if (count($game->getProvision()) > 0): ?>
        <?php foreach($game->getProvision() as $index => $provision): ?>
            <div class="provision-card">
                <span class="icon" style="font-size: 2em;"><?= $provision->getIcon() ?></span>
                <strong><?= $provision->getName() ?></strong>
                <span>❤️ Santé : <?= $provision->getHealthPoints() ?></span>
                <span>😊 Humeur : <?= $provision->getMoodPoints() ?></span>
                <span>🍖 Faim : <?= $provision->getHungerPoints() ?></span>
                <span>💧 Soif : <?= $provision->getThirstPoints() ?></span>
                
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune provision disponible.</p>
    <?php endif; ?>
</div>

<?php if ($game->getMessages()): ?>
    <div class="messages">
        <?php foreach ($game->getMessages() as $message): ?>
            <p><?= htmlspecialchars($message) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

</body>
</html>
