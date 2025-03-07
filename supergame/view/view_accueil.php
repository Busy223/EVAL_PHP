<!-- VUE DE LA PAGE D'ACCUEIL -->
<main>
    <section>

        <form action="" method="post">
            <h2 style="text-align:center;">Inscrivez vous !</h2>
            
            <input type="text" name="pseudo" placeholder="pseudo"  required>
            
            <input type="email" name="email" placeholder="email" required>
            
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="text" name="score" placeholder="score" required>
            
            <input type="submit" value="Ajouter votre Compte" name="submit">
        </form>
    </section>
    <section>
        <h2>Liste des personnage</h2>
    <p >
        $message
    </p>
    <p>
        $listUsers
    </p>
            
    </section>
</main>