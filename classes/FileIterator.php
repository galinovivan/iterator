<?php
/**
 * Created by PhpStorm.
 * User: master
 * Date: 04.05.2017
 * Time: 10:33
 */


namespace project\classes;


class FileIterator implements \SeekableIterator
{

    const DIRECTORY_SEPARATOR = '/';
    private $position = 0;
    private $filePath;
    private $partSize;
    private $fileFlow;
    private $writeMode = 'r';

    /**
     * FileIterator constructor.
     * @param $filePath
     * @param $partSize
     * @param $writeMode
     */
    public function __construct($filePath, $partSize, $writeMode)
    {
        $this->setPartSize($partSize);
        $this->setWriteMode($writeMode);

            $this->filePath = $filePath;
            $this->fileFlow = fopen($filePath, $writeMode);
        
    }

    public function testMode()
    {
        
        return $this->filePath;
        
    }

    /**
     * @param $writeMode
     */
    public function setWriteMode($writeMode)
    {

        $this->writeMode = $writeMode;

    }

    /**
     * @return string
     */
    public function getWriteMode()
    {

        return (string) $this->writeMode;

    }

    /**
     * @param $partSize
     */
    public function setPartSize($partSize)
    {

        $this->partSize = (int) $partSize;

    }

    /**
     * @return int
     */
    public function getPartSize()
    {

        return $this->partSize;

    }


    public function setFilePath($filePath)
    {

        $this->filePath = $filePath;

    }

    public function getFilePath()
    {

        return $this->filePath;

    }

    public function setPosition($position)
    {

        $this->position = (int) $position;

    }

    public function getPosition()
    {

        return $this->position;

    }

    /**
     *
     */
    public function next()
    {
        $this->position++;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return true;
    }

    /**
     * @return string
     */
    public function current()
    {


        $this->seek($this->position);

        return fread($this->fileFlow, $this->partSize);
    }

    /**
     *
     */
    public function rewind()
    {

        $this->setPosition(0);
        
        rewind($this->fileFlow);

    }

    /**
     * @param int $position
     */
    public function seek($position)
    {
        $this->setPosition($position);


        if (!$this->valid()) {
            throw new \OutOfBoundsException("position not valid; $position");
        }

        fseek($this->fileFlow, $this->position * $this->partSize);
    }

    /**
     *
     */
    public function key()
    {
        return $this->position;
    }

}