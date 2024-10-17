<?php

declare(strict_types=1);

$year = date('Y');

// In case you would like to use $header, uncomment header_comment
$header = '';

$rules = [
    // https://mlocati.github.io/php-cs-fixer-configurator/#version:3.11
    // '@PHPUnit75Migration:risky' => true,
    // 'psr_autoloading' => ['dir' => './src'], // Classes must be in a path that matches their namespace, be at least one namespace deep and the class name should match the file name.
    'declare_parentheses'     => true, // There must not be spaces around `declare` statement parentheses.
    'declare_equal_normalize' => ['space' => 'none'], // Equal sign in declare statement should be surrounded by spaces or not following configuration.
    'declare_strict_types'    => true, // Risky: Force strict types declaration in all files. Requires PHP >= 7.0.
    'strict_param'            => true, // Risky: Functions should be used with `$strict` param set to `true`. The functions "array_keys", "array_search", "base64_decode", "in_array" and "mb_detect_encoding" should be used with $strict param.
    // 'strict_comparison' => false, // Comparisons should be strict.
    'error_suppression' => true, // Risky: Error control operator should be added to deprecation notices and/or removed from other cases.
    'encoding'          => true, // PHP code MUST use only UTF-8 without BOM (remove BOM).
    // 'no_homoglyph_names' => true, // Risky: Replace accidental usage of homoglyphs (non ascii characters) in names.
    'non_printable_character'     => ['use_escape_sequences_in_strings' => false], // Risky: Remove Zero-width space (ZWSP), Non-breaking space (NBSP) and other invisible unicode symbols.
    'indentation_type'            => true, // Code MUST use configured indentation type.
    'heredoc_indentation'         => true, // Heredoc/nowdoc content must be properly indented. Requires PHP >= 7.3.
    'statement_indentation'       => true, // Each statement must be indented.
    'method_chaining_indentation' => true, // Method chaining MUST be properly indented. Method chaining with different levels of indentation is not supported.
    'array_indentation'           => true, // Each element of an array must be indented exactly once.
    'array_syntax'                => ['syntax' => 'short'], // PHP arrays should be declared using the configured syntax.
    'list_syntax'                 => ['syntax' => 'short'], // List (`array` destructuring) assignment should be declared using the configured syntax. Requires PHP >= 7.1.
    'class_attributes_separation' => ['elements' => ['const' => 'one', 'method' => 'one', 'property' => 'one', 'trait_import' => 'none', 'case' => 'none']], // Class, trait and interface elements must be separated with 'one' or 'none' blank line.
    'class_reference_name_casing' => true, // When referencing an internal class it must be written using the correct casing.
    'class_definition'            => ['single_item_single_line' => true, 'single_line' => true, 'space_before_parenthesis' => true, 'inline_constructor_arguments' => false, 'multi_line_extends_each_single_line' => false], // Whitespace around the keywords of a class, trait or interfaces definition should be one space.
    'get_class_to_class_keyword'  => true, // Risky: Replace `get_class` calls on object variables with class keyword syntax.
    // 'final_class' => false, // Risky: All classes must be final, except abstract ones and Doctrine entities.
    // 'final_internal_class' => false, // Risky: Internal classes should be `final`.
    'ordered_class_elements' => ['order' => ['use_trait']], // Orders the elements of classes/interfaces/traits/enums.
    // 'ordered_interfaces' => ['direction' => 'ascend', 'order' => 'alpha'], // Risky: Orders the interfaces in an `implements` or `interface extends` clause.
    // 'ordered_traits' => true, // Risky: Trait `use` statements must be sorted alphabetically.
    'ordered_imports'         => ['imports_order' => ['class', 'function', 'const']/* 'sort_algorithm' => 'none' */], // Ordering `use` statements.
    'global_namespace_import' => ['import_classes' => true, // 'import_functions' => true, 'import_constants' => true
    ], // Imports or fully qualifies global classes/functions/constants.
    // 'group_import' => true, // There MUST be group use for the same namespaces.
    'single_import_per_statement'        => ['group_to_single_imports' => true], // There MUST be one use keyword per declaration.
    'no_unused_imports'                  => true, // Unused use statements must be removed.
    'no_unneeded_import_alias'           => true, // Imports should not be aliased as the same name.
    'no_leading_import_slash'            => true, // Remove leading slashes in `use` clauses.
    'lambda_not_used_import'             => true, // Lambda must not import variables it doesn't use.
    'include'                            => true, // Include/Require and file path should be divided with a single space. File path should not be placed under brackets.
    'single_class_element_per_statement' => ['elements' => ['const', 'property']], // There MUST NOT be more than one property or constant declared per statement.
    'single_trait_insert_per_statement'  => true, // Each trait `use` must be done as single statement.
    // 'no_php4_constructor' => true, // Risky: when old style constructor being fixed is overridden or overrides parent one. Convert PHP4-style constructors to __construct.
    // 'escape_implicit_backslashes' => true, // Escape implicit backslashes in strings and heredocs to ease the understanding of which are special chars interpreted by PHP and which not.
    'explicit_indirect_variable' => true, // Add curly braces to indirect variables to make them clear to understand. Requires PHP >= 7.0.
    'explicit_string_variable'   => true, // Converts implicit variables into explicit ones in double-quoted strings or heredoc syntax.
    // 'simple_to_complex_string_variable' => true, // Converts explicit variables in double-quoted strings and heredoc syntax from simple to complex format (`${` to `{$`). Doesn't touch implicit variables. Works together nicely with `explicit_string_variable`.
    'single_quote' => true, // Convert double quotes to single quotes for simple strings.
    // 'no_binary_string' => true, // There should not be a binary flag before strings.
    // 'string_length_to_empty' => true, // Risky: String tests for empty must be done against '', not with `strlen`.
    // 'string_line_ending' => false, // All multi-line strings must use correct line ending.
    // 'native_function_invocation' => ['scope' => 'namespaced', 'strict' => true, 'exclude' => [], 'include' => ['@compiler_optimized']], // Risky: Add leading `\` before function invocation to speed up resolving.
    'native_constant_invocation' => ['scope' => 'namespaced', // 'fix_built_in' => true, 'strict' => true, 'exclude' => ['M_PI'], 'include' => ['MY_CUSTOM_CONST']
    ], // Risky: Add leading `\` before constant invocation of internal constant to speed up resolving. Constant name match is case-sensitive, except for `null`, `false` and `true`.
    'clean_namespace'               => true, // Namespace must not contain spacing, comments or PHPDoc.
    'types_spaces'                  => ['space' => 'none', 'space_multiple_catch' => null], // A single space or none should be around union type and intersection type operators.
    'cast_spaces'                   => ['space' => 'single'], // A `single` space or `none` should be between cast and variable.
    'concat_space'                  => ['spacing' => 'one'], // Concatenation should be spaced according configuration.
    'no_spaces_around_offset'       => ['positions' => ['inside', 'outside']], // There MUST NOT be spaces around offset braces.
    'no_space_around_double_colon'  => true, // There must be no space around double colons (also called Scope Resolution Operator or Paamayim Nekudotayim).
    'no_spaces_inside_parenthesis'  => true, // There MUST NOT be a space after the opening parenthesis. There MUST NOT be a space before the closing parenthesis.
    'no_spaces_after_function_name' => true, // When making a method or function call, there MUST NOT be a space between the method or function name and the opening parenthesis.
    'function_declaration'          => ['closure_function_spacing' => 'one', 'trailing_comma_single_line' => false], // Spaces should be properly placed in a function declaration.
    'function_typehint_space'       => true, // Ensure single space between function's argument and its typehint.
    'compact_nullable_typehint'     => true, // Remove extra spaces in a nullable typehint.
    'method_argument_space'         => ['on_multiline' => 'ensure_fully_multiline', 'keep_multiple_spaces_after_comma' => false, 'after_heredoc' => false], // In method arguments and method call, there MUST NOT be a space before each comma and there MUST be one space after each comma.
    // 'no_unreachable_default_argument_value' => true, // In function arguments there must not be arguments with default values before non-default ones.
    'return_assignment'            => true, // Local, dynamic and directly referenced variables should not be assigned and directly returned by a function or method.
    'return_type_declaration'      => ['space_before' => 'none'], // Adjust spacing around colon in return type declarations and backed enum types.
    'single_space_after_construct' => ['constructs' => ['abstract', 'as', 'attribute', 'break', 'case', 'catch', 'class', 'clone', 'comment', 'const', 'const_import', 'continue', 'do', 'echo', 'else', 'elseif', 'extends', 'final',
        'finally', 'for', 'foreach', 'function', 'function_import', 'global', 'goto', 'if', 'implements', 'include', 'include_once', 'instanceof', 'insteadof', 'interface', 'match', 'named_argument', 'new', 'open_tag_with_echo',
        'php_doc', 'php_open', 'print', 'private', 'protected', 'public', 'require', 'require_once', 'return', 'static', 'throw', 'trait', 'try', 'use', 'use_lambda', 'use_trait', 'var', 'while', 'yield', 'yield_from', ]], // Ensures a single space after language constructs.
    'multiline_whitespace_before_semicolons'      => ['strategy' => 'no_multi_line'], // Forbid multi-line whitespace before the closing semicolon or move the semicolon to the new line for chained calls.
    'no_singleline_whitespace_before_semicolons'  => true, // Single-line whitespace before closing semicolon are prohibited.
    'space_after_semicolon'                       => ['remove_in_empty_for_expressions' => true], // Fix whitespace after a semicolon.
    'semicolon_after_instruction'                 => true, // Instructions must be terminated with a semicolon.
    'no_empty_statement'                          => true, // Remove useless (semicolon) statements.
    'no_trailing_whitespace'                      => true, // Remove trailing whitespace at the end of non-blank lines.
    'no_trailing_whitespace_in_comment'           => true, // There MUST be no trailing spaces inside comment or PHPDoc.
    'no_trailing_whitespace_in_string'            => true, // There must be no trailing whitespace in strings.
    'no_trailing_comma_in_singleline'             => ['elements' => ['arguments', 'array_destructuring', 'array', 'group_import']], // If a list of values separated by a comma is contained on a single line, then the last item MUST NOT have a trailing comma.
    'trailing_comma_in_multiline'                 => true, // Multi-line arrays, arguments list, parameters list and match expressions must have a trailing comma.
    'no_whitespace_before_comma_in_array'         => true, // In array declaration, there MUST NOT be a whitespace before each comma.
    'whitespace_after_comma_in_array'             => ['ensure_single_space' => true], // In array declaration, there MUST be a whitespace after each comma.
    'no_multiline_whitespace_around_double_arrow' => true, // Operator `=>` should not be surrounded by multi-line whitespaces.
    'trim_array_spaces'                           => true, // Arrays should be formatted like function/method arguments, without leading or trailing single line space.
    'switch_case_space'                           => true, // Removes extra spaces between colon and case value.
    'switch_case_semicolon_to_colon'              => true, // A case should be followed by a colon and not a semicolon.
    'switch_continue_to_break'                    => true, // Switch case must not be ended with `continue` but with `break`.
    'operator_linebreak'                          => ['only_booleans' => true, 'position' => 'end'], // Operators - when multiline - must always be at the beginning or at the end of the line.
    'object_operator_without_whitespace'          => true, // There should not be space before or after object operators `->` and `?->`.
    'not_operator_with_successor_space'           => true, // Logical NOT operators (`!`) should have one trailing whitespace.
    // 'not_operator_with_space' => true, // Logical NOT operators (`!`) should have leading and trailing whitespaces.
    // 'binary_operator_spaces' => true, // Binary operators should be surrounded by space as configured.
    'binary_operator_spaces' => [
        'operators' => [
            '=>' => 'align_single_space_minimal',
        ],
    ],
    'unary_operator_spaces'   => true, // Unary operators should be placed adjacent to their operands.
    'ternary_operator_spaces' => true, // Standardize spaces around ternary operator.
    // 'logical_operators' => false, // Risky: Use && and || logical operators instead of and and or.
    'ternary_to_elvis_operator'                => true, // Risky: Use the Elvis operator `?:` where possible.
    'ternary_to_null_coalescing'               => true, // Use `null` coalescing operator `??` where possible. Requires PHP >= 7.0.
    'assign_null_coalescing_to_coalesce_equal' => true, // Use the null coalescing assignment operator ??= where possible.
    // 'is_null' => false, // Replaces is_null($var) expression with null === $var.
    'dir_constant'                    => true, // Replaces `dirname(__FILE__)` expression with equivalent `__DIR__` constant.
    'combine_nested_dirname'          => true, //  Risky: Replace multiple nested calls of `dirname` by only one call with second `$level` parameter. Requires PHP >= 7.0.
    'combine_consecutive_issets'      => true, // Using `isset($var) &&` multiple times should be done in one call.
    'combine_consecutive_unsets'      => true, // Calling `unset` on multiple items should be done in one call.
    'no_multiple_statements_per_line' => true, // There must not be more than one statement per line.
    'array_push'                      => true, // Risky: Converts simple usages of `array_push($x, $y);` to $`x[] = $y;`.
    'implode_call'                    => true, // Risky: Function `implode` must be called with 2 arguments in the documented order.
    'regular_callable_call'           => true, // Risky: Callables must be called without using `call_user_func*` when possible.
    'function_to_constant'            => ['functions' => ['get_called_class', 'get_class', 'get_class_this', 'php_sapi_name', 'phpversion', 'pi']], // Risky: Replace core functions calls returning constants with the constants.
    'backtick_to_shell_exec'          => true, // Converts backtick operators to `shell_exec` calls.
    'pow_to_exponentiation'           => true, // Risky: Converts `pow()` to the `**` operator.
    'random_api_migration'            => true, // Replaces `rand`, `srand`, `getrandmax` functions calls with their `mt_*` analogs or `random_int`.
    // 'mb_str_functions' => true, // Risky: Replace non multibyte-safe functions with corresponding mb function.
    'ereg_to_preg'           => true, // Risky: Replace deprecated `ereg` regular expression functions with `preg`.
    'heredoc_to_nowdoc'      => true, // Convert `heredoc` to `nowdoc` where possible.
    'modernize_strpos'       => true, // Risky: Replace `strpos()` calls with `str_starts_with()` or `str_contains()` if possible.
    'standardize_not_equals' => true, // Replace all `<>` with `!=`.
    'standardize_increment'  => true, // Increment and decrement operators should be used if possible.
    // 'increment_style' => ['style' => 'pre'], // Pre- or post-increment and decrement operators should be used if possible.
    'octal_notation' => true, // Literal octal must be in 0o notation.
    // 'no_unset_on_property' => false, // Risky: Properties should be set to `null` instead of using `unset`.
    'no_unset_cast'           => true, // Variables must be set `null` instead of using `(unset)` casting.
    'no_short_bool_cast'      => true, // Short cast `bool` using, double exclamation mark should not be used.
    'short_scalar_cast'       => true, // Cast `(boolean)` and `(integer)` should be written as `(bool)` and `(int)`, `(double)` and `(real)` as `(float)`.
    'modernize_types_casting' => true, // Risky: Replaces `intval`, `floatval`, `doubleval`, `strval` and `boolval` function calls with according type casting operator.
    // 'set_type_to_cast' => true, // Risky: Cast shall be used, not `settype`.
    'lowercase_cast'                          => true, // Cast should be written in lower case.
    'lowercase_keywords'                      => true, // PHP keywords MUST be in lower case.
    'lowercase_static_reference'              => true, // Class static references `self`, `static` and `parent` MUST be in lower case.
    'magic_constant_casing'                   => true, // Magic constants should be referred to using the correct casing.
    'magic_method_casing'                     => true, // Magic method definitions and calls must be using the correct casing.
    'native_function_casing'                  => true, // Function defined by PHP should be called using the correct casing.
    'native_function_type_declaration_casing' => true, // Native type hints for functions should use the correct case.
    'integer_literal_case'                    => true, // Integer literals must be in correct case.
    'constant_case'                           => ['case' => 'lower'], // The PHP constants `true`, `false`, and `null` MUST be written using the correct casing.
    'no_alias_functions'                      => ['sets' => ['@all', // '@internal','@exif','@ftp','@IMAP','@ldap','@mbreg','@mysqli','@oci','@odbc','@openssl','@pcntl','@pg','@posix','@snmp','@sodium','@time'
    ]], // Risky: Master functions shall be used instead of aliases.
    'no_alias_language_construct_call' => true, // Master language constructs shall be used instead of aliases.
    // 'no_alternative_syntax' => true, // Replace control structure alternative syntax to use braces.
    // 'self_accessor' => true, // Risky: Inside class or interface element `self` should be preferred to the class name itself.
    'self_static_accessor' => true, // Inside a `final` class or anonymous class `self` should be preferred to `static`.
    // 'static_lambda' => true, // Risky: Lambdas not (indirect) referencing `$this` must be declared `static`.
    // 'use_arrow_functions' => false, // Anonymous functions with one-liner return statement must use arrow functions.
    'fully_qualified_strict_types' => true, // Transforms imported FQCN parameters and return types in function arguments to short version.
    'visibility_required'          => ['elements' => ['const', 'method', 'property']], // Visibility MUST be declared on all properties and methods; `abstract` and `final` MUST be declared before the visibility; `static` MUST be declared after the visibility.
    'protected_to_private'         => true, // Converts `protected` variables and methods to `private` where possible.
    'no_unneeded_final_method'     => ['private_methods' => false], // Risky: Removes `final` from methods where possible.
    // 'final_public_method_for_abstract_class' => false, // Risky: All `public` methods of `abstract` classes should be `final`.
    'no_null_property_initialization'                  => true, // Properties MUST not be explicitly initialized with null except when they have a type declaration (PHP 7.4).
    'nullable_type_declaration_for_default_null_value' => ['use_nullable_type_declaration' => true], // Adds or removes ? before type declarations for parameters with a default null value.
    'simplified_if_return'                             => true, // Simplify `if` control structures that return the boolean result of their condition.
    // 'simplified_null_return' => false, // A return statement wishing to return `void` should not return `null`.
    // 'void_return' => true, // Risky: Add `void` return type to functions with missing or empty return statements, but priority is given to `@return` annotations. Requires PHP >= 7.1.
    'no_useless_nullsafe_operator' => true, // There should not be useless `null-safe-operators ?->` used.
    'no_useless_return'            => true, // There should not be an empty return statement at the end of a function.
    'no_useless_sprintf'           => true, // Risky: There must be no `sprintf` calls with only the first argument.
    'no_useless_else'              => true, // There should not be useless `else` cases.
    'no_superfluous_elseif'        => true, // Replaces superfluous `elseif` with `if`.
    'elseif'                       => true, // The keyword `elseif` should be used instead of `else if` so that all control keywords look like single words.
    // 'header_comment'                                   => ['header' => $header, 'comment_type' => 'comment', 'location' => 'after_declare_strict', 'separate' => 'both'], // Add, replace or remove header comment.
    // 'comment_to_phpdoc' => true, // Risky: Comments with annotation should be docblock when used on structural elements.
    'single_line_comment_style'        => ['comment_types' => ['asterisk', 'hash']], // Single-line comments and multi-line comments with only one line of actual content should use the `//` syntax.
    'single_line_comment_spacing'      => true, // Single-line comments must have proper spacing.
    'phpdoc_to_comment'                => true, // Docblocks should only be used on structural elements.
    'phpdoc_annotation_without_dot'    => true, // PHPDoc annotation descriptions should not be a sentence.
    'phpdoc_summary'                   => true, // PHPDoc summary should end in either a full stop, exclamation mark, or question mark.
    'general_phpdoc_annotation_remove' => ['annotations' => ['expectedDeprecation']], // Configured annotations should be omitted from PHPDoc.
    'general_phpdoc_tag_rename'        => ['replacements' => ['inheritDocs' => 'inheritDoc'], 'case_sensitive' => true], // Renames PHPDoc tags.
    // 'no_superfluous_phpdoc_tags' => false, // Removes @param, @return and @var tags that don't provide any useful information.
    'phpdoc_tag_type' => ['tags' => ['api' => 'annotation', 'author' => 'annotation', 'copyright' => 'annotation', 'deprecated' => 'annotation', 'example' => 'annotation', 'global' => 'annotation',
        'inheritDoc'                       => 'annotation', 'internal' => 'annotation', 'license' => 'annotation', 'method' => 'annotation', 'package' => 'annotation', 'param' => 'annotation', 'property' => 'annotation',
        'return'                           => 'annotation', 'see' => 'annotation', 'since' => 'annotation', 'throws' => 'annotation', 'todo' => 'annotation', 'uses' => 'annotation', 'var' => 'annotation', 'version' => 'annotation',
    ]], // Forces PHPDoc tags to be either regular annotations or inline.
    'phpdoc_no_alias_tag'          => true, // ['replacements' => ['property-read' => 'property', 'property-write' => 'property', 'type' => 'var', 'link' => 'see']], // No alias PHPDoc tags should be used.
    'phpdoc_inline_tag_normalizer' => true, // Fixes PHPDoc inline tags.
    'phpdoc_separation'            => ['groups' => [
        ['deprecated', 'link', 'see', 'since'],
        ['author', 'copyright', 'license'],
        ['category', 'package', 'subpackage'],
        ['property', 'property-read', 'property-write'],
        ['param', 'return', 'throws'],
    ]], // Annotations in PHPDoc should be grouped together so that annotations of the same type immediately follow each other, and annotations of a different type are separated by a single blank line.
    'phpdoc_line_span'                              => true, // Changes doc blocks from single to multi line, or reversed. Works for class constants, properties and methods only.
    'phpdoc_trim'                                   => true, // PHPDoc should start and end with content, excluding the very first and last line of the docblocks.
    'phpdoc_trim_consecutive_blank_line_separation' => true, // Removes extra blank lines after summary and after description in PHPDoc.
    'no_blank_lines_after_phpdoc'                   => true, // There should not be blank lines between docblock and the documented element.
    'phpdoc_single_line_var_spacing'                => true, // Single line `@var` PHPDoc should have proper spacing.
    'phpdoc_indent'                                 => true, // Docblocks should have the same indentation as the documented subject.
    'multiline_comment_opening_closing'             => true, // DocBlocks must start with two asterisks, multiline comments must start with a single asterisk, after the opening slash. Both must end with a single asterisk before the closing slash.
    'align_multiline_comment'                       => ['comment_type' => 'phpdocs_only'], // Each line of multi-line DocComments must have an asterisk [PSR-5] and must be aligned with the first one.
    'phpdoc_align'                                  => ['align' => 'vertical', 'tags' => ['method', 'param', 'property', 'property-read', 'property-write', 'return', 'throws', 'type', 'var']], // All items of the given phpdoc tags must be either left-aligned or (by default) aligned vertically.
    'phpdoc_scalar'                                 => true, // Scalar types should always be written in the same form. `int` not `integer`, `bool` not `boolean`, `float` not `real` or `double`.
    'phpdoc_no_access'                              => true, // `@access` annotations should be omitted from PHPDoc.
    'phpdoc_no_package'                             => true, // `@package` and `@subpackage` annotations should be omitted from PHPDoc.
    'phpdoc_no_useless_inheritdoc'                  => true, // Classy that does not inherit must not have `@inheritdoc` tags.
    'phpdoc_var_without_name'                       => true, // `@var` and `@type` annotations of classy properties should not contain the name.
    'phpdoc_var_annotation_correct_order'           => true, // @var and @type annotations must have type and name in the correct order.
    'phpdoc_add_missing_param_annotation'           => ['only_untyped' => false], // PHPDoc should contain `@param` for all params.
    // 'phpdoc_to_property_type' => ['scalar_types' => true], // EXPERIMENTAL: Takes `@var` annotation of non-mixed types and adjusts accordingly the property signature. Requires PHP >= 7.4.
    // 'phpdoc_to_param_type' => ['scalar_types' => true], // EXPERIMENTAL: Takes `@param` annotations of non-mixed types and adjusts accordingly the function signature. Requires PHP >= 7.0.
    // 'phpdoc_to_return_type' => ['scalar_types' => true], // EXPERIMENTAL: Takes `@return` annotation of non-mixed types and adjusts accordingly the function signature. Requires PHP >= 7.0.
    'phpdoc_tag_casing'  => ['tags' => ['inheritDoc']], // Fixes casing of PHPDoc tags.
    'phpdoc_types'       => true, // The correct case must be used for standard PHP types in PHPDoc.
    'phpdoc_types_order' => ['null_adjustment' => 'always_first', 'sort_algorithm' => 'none'], // Sorts PHPDoc types.
    'phpdoc_order'       => ['order' => ['param', 'return', 'throws']], // Annotations in PHPDoc should be ordered so that @param annotations come first, then @throws annotations, then @return annotations.
    // 'phpdoc_order_by_value' => ['annotations' => ['author']], // Order phpdoc tags by value.
    'phpdoc_return_self_reference' => ['replacements' => ['this' => '$this', '@this' => '$this', '$self' => 'self', '@self' => 'self', '$static' => 'static', '@static' => 'static']], // The type of `@return` annotations of methods returning a reference to itself must the configured one.
    // 'phpdoc_no_empty_return' => true, // `@return void` and `@return null` annotations should be omitted from PHPDoc.
    'no_empty_phpdoc'      => true, // There should not be empty PHPDoc blocks.
    'no_empty_comment'     => true, // There should not be any empty comments.
    'no_break_comment'     => ['comment_text' => 'no break'], // There must be a comment when fall-through is intentional in a non-empty case body. Adds a "no break" comment before fall-through cases, and removes it if there is no fall-through.
    'empty_loop_body'      => ['style' => 'semicolon'], // Empty loop-body must be in configured style.
    'empty_loop_condition' => ['style' => 'while'], // Empty loop-condition must be in configured style.
    'full_opening_tag'     => true, // PHP code must use the long `<?php` tags or short-echo `<?=` tags and not other tag variations.
    'echo_tag_syntax'      => ['format' => 'short', 'shorten_simple_statements_only' => false], // Replaces short-echo `<?=` with long format `<?php echo/<?php print` syntax, or vice-versa.
    'no_mixed_echo_print'  => true, // Either language construct `print` or `echo` should be used.
    'no_closing_tag'       => true, // The closing tag MUST be omitted from files containing only PHP.
    'line_ending'          => true, // All PHP files must use same line ending.
    // 'linebreak_after_opening_tag' => true, // Ensure there is no code on the same line as the PHP open tag.
    'blank_line_after_opening_tag' => true, // Ensure there is no code on the same line as the PHP open tag and it is followed by a blank line.
    'single_blank_line_at_eof'     => true, // A PHP file without end tag must always end with a single empty line feed.
    // 'no_blank_lines_before_namespace' => false, // There should be no blank lines before a namespace declaration.
    'single_blank_line_before_namespace' => true, // There should be exactly one blank line before a namespace declaration.
    'blank_line_after_namespace'         => true, // There MUST be one blank line after the namespace declaration.
    'no_leading_namespace_whitespace'    => true, // The namespace declaration line shouldn't contain leading whitespace.
    'no_blank_lines_after_class_opening' => true, // There should be no empty lines after class opening brace.
    'single_line_throw'                  => true, // Throwing exception must be done in single line.
    'single_line_after_imports'          => true, // Each namespace use MUST go on its own line and there MUST be one blank line after the use statements block.
    'blank_line_between_import_groups'   => true, // Putting blank lines between `use` statement groups.
    'blank_line_before_statement'        => true, // ['statements' => ['break', 'case', 'continue', 'declare', 'default', 'die', 'do', 'exit', 'for', 'foreach', 'goto', 'if', 'include', 'include_once', 'require', 'require_once', 'return', 'switch', 'throw', 'try', 'while', 'yield', 'yield_from']], // An empty line feed must precede any configured statement.
    'no_extra_blank_lines'               => ['tokens' => ['attribute', 'break', 'case', 'continue', 'curly_brace_block', 'default', 'extra', 'parenthesis_brace_block', 'return', 'square_brace_block', 'switch', 'throw', 'use', // 'use_trait',
    ]], // Removes extra blank lines and/or blank lines following configuration.
    'no_whitespace_in_blank_line' => true, // Remove trailing whitespace at the end of blank lines.
    'braces'                      => ['allow_single_line_anonymous_class_with_empty_body' => true, // 'allow_single_line_closure' => false, 'position_after_functions_and_oop_constructs' => 'next', 'position_after_control_structures' => 'same', 'position_after_anonymous_constructs' => 'same'
    ], // The body of each structure MUST be enclosed by braces. Braces should be properly placed. Body of braces should be properly indented.
    'curly_braces_position' => [
        'allow_single_line_anonymous_functions' => true, 'allow_single_line_empty_anonymous_classes' => true,
        'anonymous_functions_opening_brace'     => 'same_line', 'anonymous_classes_opening_brace' => 'same_line', 'control_structures_opening_brace' => 'same_line',
        'functions_opening_brace'               => 'next_line_unless_newline_at_signature_end', 'classes_opening_brace' => 'next_line_unless_newline_at_signature_end',
    ], // Curly braces must be placed as configured.
    'control_structure_braces'                => true, // The body of each control structure MUST be enclosed within braces.
    'control_structure_continuation_position' => ['position' => 'same_line'], // Control structure continuation keyword must be on the configured line.
    'new_with_braces'                         => ['anonymous_class' => true, 'named_class' => true], // All instances created with `new` keyword must (not) be followed by braces.
    // 'normalize_index_brace' => true, // Array index should always be written by using square braces.
    'no_unneeded_curly_braces'        => ['namespaces' => true], // Removes unneeded curly braces that are superfluous and aren't part of a control structure's body.
    'no_unneeded_control_parentheses' => ['statements' => ['break', 'clone', 'continue', 'echo_print', 'negative_instanceof', 'others', 'return', 'switch_case', 'yield', 'yield_from']], // Removes unneeded parentheses around control statements.
    // 'date_time_create_from_format_call' => false, // Risky: The first argument of `DateTime::createFromFormat` method must start with `!`.
    // 'date_time_immutable' => true, // Risky: Class `DateTimeImmutable` should be used instead of `DateTime`.
    // 'fopen_flags' => true, // Risky: The flags in `fopen` calls must omit `t`, and `b` must be omitted or included consistently.
    // 'fopen_flag_order' => true, // Risky: Order the flags in `fopen` calls, `b` and `t` must be last.
    'yoda_style' => ['always_move_variable' => false, 'equal' => true, 'identical' => false, 'less_and_greater' => null], // Write conditions in Yoda style (`true`), non-Yoda style (`['equal' => false, 'identical' => false, 'less_and_greater' => false]`) or ignore those conditions (`null`) based on configuration.
];

$finder = PhpCsFixer\Finder::create()->
ignoreDotFiles(false)->
ignoreVCSIgnored(true); /*->append([
        __DIR__.'/dev-tools/doc.php',
        // __DIR__.'/php-cs-fixer', disabled, as we want to be able to run bootstrap file even on lower PHP version, to show nice message
    ])*/

$config = new PhpCsFixer\Config();
$config->
setCacheFile(__DIR__ . '/storage/cache/.php-cs-fixer.cache')->
setRiskyAllowed(true)->
setRules($rules)->
setFinder($finder);

return $config;
