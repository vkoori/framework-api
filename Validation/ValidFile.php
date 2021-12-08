<?php

namespace Rakit\Validation\Rules;
use Rakit\Validation\Rule;

class ValidFile extends Rule {
	use Traits\FileTrait;
	/** @var string */
	protected $message = ":attribute file is invalid";

	/**
	 * Check the $value is accepted
	 *
	 * @param mixed $value
	 * @return bool
	 */
	public function check($value): bool
	{
		if (!$this->isValueFromUploadedFiles($value) or $value['error'] == UPLOAD_ERR_NO_FILE) {
			return false;
		}
		
		if (is_array($value['size'])) {
			foreach ($value['size'] as $size) {
				if ($size == 0)
					return false;
			}
		} else {
			if ($value['size'] == false)
				return false;
		}

		return true;
	}
}