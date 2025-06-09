<?php
function Auth($firstName = true, $lastName = true, $buttonName, $buttonTitle, $error=null, $isRegister=true) {
?>
<style>
    /* Remove the white background on autocomplete dropdown */
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
        -webkit-box-shadow: 0 0 0 30px rgba(255, 255, 255, 0.5) inset !important;
        -webkit-text-fill-color: #000 !important;
    }

    /* Ensure the input fields have transparent background */
    .custom-input {
        background-color: transparent !important;
    }
</style>

<div class="w-full h-screen" style="background-image:url('../../assets/img/bg/regis.jpg'); background-size:cover">
    <section class="max-w-5xl px-12 py-16 mx-auto ">
        <div class="card-regis items-center px-12 py-8 flex flex-col gap-y-10  mx-auto w-fit bg-white/20 backdrop-blur-md rounded-xl shadow-md">
            <div class="header flex flex-col gap-y-4">
                <h1 class="mx-auto text-2xl font-bold">
                    JWP-WO
                </h1>
                
                <?php if ($isRegister): ?>
                <p class="text-lg text-center">
                    Register your account here!
                </p>
                <?php else: ?>
                <p class="text-lg text-center">
                    Login to your account here!
                </p>
                <?php endif; ?>
           
                        
            </div>
            <form action="" method="post" class="flex flex-col gap-y-8">
                <div class="<?php if (!$firstName && !$lastName) echo 'hidden'; ?> flex flex-row gap-x-4 justify-between"> 
                    <?php if ($firstName): ?>
                    <input type="text" name="firstName" id="firstName" required placeholder="First Name" class="py-2 custom-input bg-transparent placeholder-black focus:placeholder-transparent font-semibold focus:outline-none focus:bg-transparent border-b-2 border-black">
                    <?php endif; ?>
                    <?php if ($lastName): ?>
                    <input type="text" name="lastName" id="lastName" required placeholder="Last Name" class="py-2 custom-input bg-transparent placeholder-black focus:placeholder-transparent font-semibold focus:outline-none focus:bg-transparent border-b-2 border-black">
                    <?php endif; ?>
                </div>
                <div class="flex flex-col gap-y-1">
                    <?php if (!empty($error)): ?>
                        <p class="text-red-600 text-base font-semibold ">
                            <?php echo $error; ?>
                        </p>
                    <?php endif;?>
                    <input type="text" name="username" id="username" required placeholder="Username" class="py-2 custom-input bg-transparent placeholder-black focus:placeholder-transparent font-semibold  focus:outline-none focus:bg-transparent border-b-2 border-black">
                </div>
                
                
                <input type="password" name="password" id="password" required placeholder="Password" class="py-2 custom-input bg-transparent placeholder-black focus:placeholder-transparent font-semibold focus:outline-none focus:bg-transparent border-b-2 border-black">
                <button type="submit" name="<?php echo $buttonName ?>" class="w-full text-white bg-black py-2 rounded-lg" <?php if (!empty($buttonId)) echo 'id="' . $buttonId . '"'; ?>>
                    <?php echo $buttonTitle?>
                </button>

                <?php if ($isRegister): ?>
                    <p class="text-base font-semibold text-center">
                        Already have an account? <a href="../pages/login.php" class="text-blue-600">Login here</a>
                    </p>
                <?php else: ?>
                    <p class="text-base font-semibold text-center">
                        Don't have an account? <a href="../pages/register.php" class="text-blue-600">Register here</a>
                    </p>
                <?php endif; ?>
            </form>
        </div>
    </section>
</div>
<?php
}
?>
