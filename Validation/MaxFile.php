<?php

namespace Rakit\Validation\Rules;

use Rakit\Validation\Rule;

class MaxFile extends Rule
{
	use Traits\FileTrait, Traits\SizeTrait;

    /** @var string */
    protected $message = "The :attribute maximum is :max";

    /** @var array */
    protected $fillableParams = ['max'];

    /**
     * Check the $value is valid
     *
     * @param mixed $value
     * @return bool
     */
    public function check($value): bool
    {
    	if (!$this->isValueFromUploadedFiles($value) or $value['error'] == UPLOAD_ERR_NO_FILE) {
			return false;
		}

        $this->requireParameters($this->fillableParams);

        $max = $this->getBytesSize($this->parameter('max'));

        if (is_array($value['size'])) {
			foreach ($value['size'] as $size) {
				if ($size > $max)
					return false;
			}
		} else {
			if ($value['size'] > $max)
				return false;
		}

        return true;
    }
}
