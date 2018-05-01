<?php

namespace Admin\Generator\Type;

final class TextareaType implements TypeInterface
{
    public function getName(): string
    {
        return "textarea";
    }

    public function getEntityProperty(): string
    {
        return <<<EOL
    /**
     * @var string
     *
     * @ORM\Type TEXT
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
                <textarea class="form-control" name="{{ item.slug }}" rows="10" id="form_edit_{{ item.slug }}">{{ "{{" }} {{ module.slugSingular }}.{{ item.slugInCamel }} {{ "}}" }}</textarea>
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
        return 500;
    }
}