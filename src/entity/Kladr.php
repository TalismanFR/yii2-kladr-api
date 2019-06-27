<?php


namespace talismanfr\kladrapi\entity;


use yii\helpers\ArrayHelper;

class Kladr
{
    /** область, регион */
    const TYPE_REGION = 'region';
    /**  район */
    const TYPE_DISTRICT = 'district';
    /**  населённый пункт */
    const TYPE_CITY = 'city';
    /** улица */
    const TYPE_STREET = 'street';
    /** строение */
    const TYPE_BUILDING = 'building';
    /** индекс */
    const TYPE_ZIP = 'zip';

    /** @var  int Идентификатор объекта */
    private $id;
    /** @var  string Название объекта */
    private $name;
    /** @var  int Почтовый индекс объекта */
    private $zip;
    /** @var  string Тип объекта полностью (область, район) */
    private $type;
    /** @var  string Тип объекта коротко (обл, р-н) */
    private $typeShort;
    /** @var  string Тип объекта из перечисления ObjectType */
    private $okato;

    private $oktmo;
    private $cadnum;
    /** @var  string ОКАТО объекта */
    private $contentType;

    /** @var string ФИАС код объекта */
    private $guid;

    /** @var string ФИАС код родителя */
    private $parentGuid;

    /**
     * Kladr constructor.
     * @param int $id
     * @param string $name
     * @param int $zip
     * @param string $type
     * @param string $typeShort
     * @param string $okato
     * @param $oktmo
     * @param $cadnum
     * @param string $contentType
     * @param string $parentGuid
     */
    public function __construct(int $id, string $name, int $zip, string $type, string $typeShort, string $okato, $oktmo, $cadnum, string $contentType,string $guid,string $parentGuid)
    {
        $this->id = $id;
        $this->name = $name;
        $this->zip = $zip;
        $this->type = $type;
        $this->typeShort = $typeShort;
        $this->okato = $okato;
        $this->oktmo = $oktmo;
        $this->cadnum = $cadnum;
        $this->contentType = $contentType;
        $this->guid=$guid;
        $this->parentGuid = $parentGuid;
    }

    public static function create(array $data):?self {
        $id=(int)ArrayHelper::getValue($data,'id',0);
        $name=ArrayHelper::getValue($data,'name','');
        $zip=(int)ArrayHelper::getValue($data,'zip',0);
        $type=ArrayHelper::getValue($data,'type','');
        $typeShort=ArrayHelper::getValue($data,'typeShort','');
        $okato=ArrayHelper::getValue($data,'okato','');
        $contentType=ArrayHelper::getValue($data,'contentType','');
        $guid=ArrayHelper::getValue($data,'guid','');
        $oktmo=ArrayHelper::getValue($data,'oktmo','');
        $parentGuid=ArrayHelper::getValue($data,'parentGuid','');
        $cadnum=ArrayHelper::getValue($data,'cadnum','');

        $kladr=new Kladr($id,$name,$zip,$type,$typeShort,$okato,$oktmo,
            $cadnum,$contentType,$guid,$parentGuid);

        return $kladr;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getZip(): int
    {
        return $this->zip;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getTypeShort(): string
    {
        return $this->typeShort;
    }

    /**
     * @return string
     */
    public function getOkato(): string
    {
        return $this->okato;
    }

    /**
     * @return mixed
     */
    public function getOktmo()
    {
        return $this->oktmo;
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * @return array
     */
    public function getParentGuid(): string
    {
        return $this->parentGuid;
    }




}