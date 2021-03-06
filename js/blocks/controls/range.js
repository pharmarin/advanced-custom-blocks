import updatePreview from "../loader/preview";

const { RangeControl } = wp.components;

const ACBRangeControl = ( props, field, block ) => {
	const { setAttributes } = props
	const attr = { ...props.attributes }
	return (
		<RangeControl
			beforeIcon={field.beforeIcon}
			afterIcon={field.afterIcon}
			label={field.label}
			help={field.help}
			required={field.required || false}
			value={attr[ field.name ] || field.default}
			onChange={rangeControl => {
				attr[ field.name ] = rangeControl
				setAttributes( attr )
			}}
			onBlur={
				updatePreview( props, block )
			}
			min={field.min}
			max={field.max}
			step={field.step}
			allowReset={field.allowReset}
		/>
	)
}

export default ACBRangeControl