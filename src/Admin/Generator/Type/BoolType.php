<?php

namespace Admin\Generator\Type;

final class BoolType implements TypeInterface
{
    public function getName(): string
    {
        return "bool";
    }

    public function getEntityProperty(): string
    {
        return <<<EOL
    /**
     * @var bool
     *
     * @ORM\Type TINYINT(1)
     * @ORM\Column {{ item.slug }}
     */
    private \${{ item.slug }} = false;
    
EOL;

    }

    public function getEntityMethods(): string
    {
        return <<<EOL
    /**
     * @return bool
     */
    public function is{{ item.slugInCamel }}(): bool
    {
        return \$this->{{ item.slug }};
    }

    /**
     * @param bool \${{ item.slug }}
     */
    public function set{{ item.slugInCamel }}(bool \${{ item.slug }})
    {
        \$this->{{ item.slug }} = \${{ item.slug }};
    }

EOL;
    }

    public function getSet(): string
    {
        return <<<EOL
        \${{ module.slugSingular }}->set{{ item.slugInCamel }}((bool) isset(\$data["{{ item.slug }}"]) ? \$data["{{ item.slug }}"] : false);
EOL;
    }

    public function getForm(): string
    {
        return <<<EOL
            <div class="checkbox">
                <label>
                    <input {{ "{%" }} if {{ module.slugSingular }}.{{ item.slugInCamel }} {{ "%}" }}checked{{ "{%" }} endif {{ "%}" }} type="checkbox" name="{{ item.slug }}" value="1">
                    {{ item.name }}
                </label>
            </div>
EOL;

    }

    public function getShow(): string
    {
        return <<<EOL
                        {{ "{{" }} {{ module.slugSingular }}.{{ item.slug }} ? "ano" : "ne" {{ "}}" }}
EOL;

    }

    public function getPriority(): int
    {
        return 400;
    }
}