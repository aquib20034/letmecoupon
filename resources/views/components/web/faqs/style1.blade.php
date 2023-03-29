<div>
    <h2 class="heading-1">Frequently Asked Questions</h2>
</div>

<div class="faqListing">
    <?php for ($i = 0; $i < 4; $i++) { ?>
        <?php //include('../components/Accordion/Style1/index.php'); ?>
        <div class="accordionStyle1">
            <div class="accordion js-accordionStyle1">
                <div class="accordion__wrapper">
                    <div class="accordion__head <?php echo "js-accordion-{$i}"; ?>" onclick="toggleAccordion(this)">
                        <h3 class="title">Accordion Title</h3>

                        <span class="icon">
                            <i class="x_arrow-down-2"></i>
                        </span>
                    </div>

                    <div class="accordion__content">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo voluptate, repudiandae quis impedit ad voluptas dolores maiores ducimus quia deserunt sed, error magni deleniti tenetur odit quibusdam ipsum ipsa cupiditate doloremque voluptatibus voluptatem possimus ratione hic veritatis! Incidunt asperiores facilis dolorem sint minus facere suscipit ullam amet. Eum, architecto perspiciatis!</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo voluptate, repudiandae quis impedit ad voluptas dolores maiores ducimus quia deserunt sed, error magni deleniti tenetur odit quibusdam ipsum ipsa cupiditate doloremque voluptatibus voluptatem possimus ratione hic veritatis! Incidunt asperiores facilis dolorem sint minus facere suscipit ullam amet. Eum, architecto perspiciatis!</p>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>