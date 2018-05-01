<?php

namespace Admin\Generator\Type;

final class ImageType implements TypeInterface
{
    public function getName(): string
    {
        return "image";
    }

    public function getEntityProperty(): string
    {
        return <<<EOL
    /**
     * @var string
     *
     * @ORM\Type VARCHAR(255)
     * @ORM\Column {{ item.slug }}
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
        if (!empty(\$files["{{ item.slug }}"]) && \$files["{{ item.slug }}"] instanceof UploadedFileInterface) {
            \${{ module.slugSingular }}->set{{ item.slugInCamel }}(\$this->uploadFile(\$files["{{ item.slug }}"]));
        }
        if (isset(\$data["{{ item.slug }}_delete"])) {
            \${{ module.slugSingular }}->set{{ item.slugInCamel }}("");
        }
EOL;
    }

    public function getForm(): string
    {
        return <<<EOL
            <div class="form-group">
                <label for="form_new_{{ item.slug }}">{{ item.name }}</label>
                <input type="file" name="{{ item.slug }}" class="form-control" id="form_new_{{ item.slug }}">
                {{ "{%" }} if {{ module.slugSingular }}.{{ item.slugInCamel }} {{ "%}" }}
                    <img style="width:auto;height:auto;max-width:200px;max-height:200px" src="upload/{{ "{{" }} {{ module.slugSingular }}.{{ item.slugInCamel }} {{ "}}" }}">
                    <br/><label><input type="checkbox" name="{{ item.slug }}_delete"> Smazat</label>
                {{ "{%" }} endif {{ "%}" }}
            </div>
EOL;

    }

    public function getShow(): string
    {
        return <<<EOL
                    {{ "{%" }} if {{ module.slugSingular }}.{{ item.slugInCamel }} {{ "%}" }}
                        <img style="width:auto;height:auto;max-width:200px;max-height:200px" src="upload/{{ "{{" }} {{ module.slugSingular }}.{{ item.slugInCamel }} {{ "}}" }}">
                    {{ "{%" }} endif {{ "%}" }}
EOL;

    }

    public function getPriority(): int
    {
        return 100;
    }
}