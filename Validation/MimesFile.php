<?php

namespace Rakit\Validation\Rules;
use Rakit\Validation\Rule;

class MimesFile extends Rule {
	use Traits\FileTrait;
	/** @var string */
    protected $message = "The :attribute file type must be :mimes";

	/**
     * Given $params and assign $this->params
     *
     * @param array $params
     * @return self
     */
	public function fillParameters(array $params): Rule
    {
        $this->params['ext'] = $params;
        $this->params['mimes'] = implode(', ', $params);
        return $this;
    }

	/**
	 * Check the $value is accepted
	 *
	 * @param mixed $value
	 * @return bool
	 */
	public function check($value): bool
	{
        $extensions = $this->parameter('ext');

		if (!$this->isValueFromUploadedFiles($value) or $value['error'] == UPLOAD_ERR_NO_FILE) {
			return false;
		}

		if (is_array($value['name'])) {
			foreach ($value['name'] as $name) {
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				if (!in_array($ext, $extensions))
					return false;
			}
		} else {
			$ext = pathinfo($value['name'], PATHINFO_EXTENSION);
			if (!in_array($ext, $extensions))
					return false;
		}

		return true;
	}
}