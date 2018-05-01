<?php

namespace Admin\Generator\Type;

final class TextType implements TypeInterface
{
    public function getName(): string
    {
        return "text";
    }

    public function getEntityProperty(): string
    {
        return <<<EOL
    /**
     * @var string
     *
     * @ORM\Type VARCHAR(255)
     * @ORM\Column {{ item.slug }}
     * @ORM\Translatable
     */
    private \${{ item.slug }} = "";
    
EOL;

    }

    public function getEntityMethods(): string
    {
        return <<<EOL
    /**
     * @return string
     */
    public function get{{ item.slugInCamel }}(): string
    {
        return \$this->{{ item.slug }};
    }

    /**
     * @param string \${{ item.slug }}
     */
    public function set{{ item.slugInCamel }}(string \${{ item.slug }})
    {
        \$this->{{ item.slug }} = \${{ item.slug }};
    }

EOL;
    }

    public function getSet(): string
    {
        return <<<EOL
        \${{ module.slugSingular }}->set{{ item.slugInCamel }}(\$data["{{ item.slug }}"]);
EOL;
    }

    public function getForm(): string
    {
        return <<<EOL
            <div class="form-group">
                <label for="form_edit_{{ item.slug }}">{{ item.name }}</label>
                <input value="{{ "{{" }} {{ module.slugSingular }}.{{ item.slugInCamel }} {{ "}}" }}" type="text" name="{{ item.slug }}" class="form-control" id="form_edit_{{ item.slug }}">
            </div>
EOL;

    }

    public function getShow(): string
    {
        return <<<EOL
                        {{ "{{" }} {{ module.slugSingular }}.{{ item.slugInCamel }} {{ "}}" }}
EOL;

    }

    public function getPriority(): int
    {
        return 600;
    }
}