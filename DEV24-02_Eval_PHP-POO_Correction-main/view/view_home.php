<!-- VIEW DE LA PAGE D'ACCUEIL -->
<form action="" method="post">
    <input type="email" name="emailCo" placeholder="Votre Email" required>
    <input type="password" name="passwordCo" placeholder="Votre Mot de Passe" required>
    <input type="submit" name="submitCo">
 </form>
 <form action="" method="post">
    <input type="text" name="pseudo" placeholder="Votre Pseudo" required>
    <input type="email" name="email" placeholder="Votre Email" required>
    <input type="number" name="score" placeholder="Votre Score" required>
    <input type="password" name="password" placeholder="Votre Mot de Passe" required>
    <input type="submit" name="submit">
 </form>
 <p><?= $message ?></p>
 <section>
    <?= $usersList ?>
 </section>